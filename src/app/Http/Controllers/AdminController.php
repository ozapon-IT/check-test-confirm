<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;

class AdminController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $contacts = Contact::with('category')->paginate(7);
        return view('admin', compact('contacts', 'categories'));
    }

    public function search(Request $request)
    {
        $contacts = $this->getFilteredContacts($request)->paginate(7);
        $categories = Category::all();

        return view('admin', compact('contacts', 'categories'));
    }

    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();
        return redirect()->route('admin.index');
    }

    // フィルタリングロジックを共通化
    private function getFilteredContacts(Request $request)
    {
        $query = Contact::query()->with('category');

        // 名前またはメールアドレスでの検索（部分一致・完全一致対応）
        if ($request->filled('keyword')) {
            $keyword = trim($request->input('keyword'));

            // 小文字に変換して大文字小文字を無視した比較を行う
            $keyword_lower = mb_strtolower($keyword);

            $query->where(function ($q) use ($keyword, $keyword_lower) {
                // first_name と last_name をスペースで連結したフルネームを作成
                $q->whereRaw('LOWER(CONCAT(first_name, " ", last_name)) = ?', [$keyword_lower])
                ->orWhereRaw('LOWER(CONCAT(last_name, " ", first_name)) = ?', [$keyword_lower])
                ->orWhereRaw('LOWER(CONCAT(first_name, last_name)) = ?', [$keyword_lower])
                ->orWhereRaw('LOWER(CONCAT(last_name, first_name)) = ?', [$keyword_lower])
                ->orWhereRaw('LOWER(email) = ?', [$keyword_lower])
                  // 部分一致検索
                ->orWhere('first_name', 'like', '%' . $keyword . '%')
                ->orWhere('last_name', 'like', '%' . $keyword . '%')
                ->orWhere('email', 'like', '%' . $keyword . '%');
            });
        }

        // 性別検索（完全一致 + 全ての選択肢対応）
        if ($request->filled('gender') && $request->input('gender') !== 'all') {
            $query->where('gender', $request->input('gender'));
        }

        // お問い合わせ種類検索（完全一致）
        if ($request->filled('category')) {
            $query->where('category_id', $request->input('category'));
        }

        // 日付検索
        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->input('date'));
        }

        return $query;
    }

     // エクスポート機能の実装
    public function export(Request $request)
    {
        $contacts = $this->getFilteredContacts($request)->get();

        // CSVヘッダー
        $csvHeader = [
            'お名前',
            '性別',
            'メールアドレス',
            '電話番号',
            '住所',
            '建物名',
            'お問い合わせの種類',
            'お問い合わせ内容'
        ];

        // CSV生成
        $callback = function() use ($contacts, $csvHeader) {
            $file = fopen('php://output', 'w');

            // Excelでの文字化けを防ぐため、BOMを追加
            fputs($file, chr(0xEF).chr(0xBB).chr(0xBF));

            // ヘッダーを書き込み
            fputcsv($file, $csvHeader);

            // データを書き込み
            foreach ($contacts as $contact) {
                $gender = '';
                if ($contact->gender == 1) {
                    $gender = '男性';
                } elseif ($contact->gender == 2) {
                    $gender = '女性';
                } else {
                    $gender = 'その他';
                }

                $row = [
                    $contact->last_name . ' ' . $contact->first_name,
                    $gender,
                    $contact->email,
                    $contact->tell,
                    $contact->address,
                    $contact->building,
                    $contact->category->content,
                    $contact->detail
                ];

                fputcsv($file, $row);
            }

            fclose($file);
        };

        // レスポンスヘッダーを設定してCSVを出力
        return response()->stream($callback, 200, [
            "Content-Type" => "text/csv",
            "Content-Disposition" => "attachment; filename=contacts.csv",
        ]);
    }
}
