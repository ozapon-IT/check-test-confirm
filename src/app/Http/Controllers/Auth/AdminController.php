<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;
use App\Services\ContactService;

class AdminController extends Controller
{
    protected $contactService;

    public function __construct(ContactService $contactService)
    {
        $this->contactService = $contactService;
    }

    public function index(Request $request)
    {
        $categories = Category::all();
        $contacts = $this->contactService->getFilteredContacts($request)
            ->paginate(7)
            ->withQueryString();
        return view('auth.admin', compact('contacts', 'categories'));
    }

    public function search(Request $request)
    {
        $categories = Category::all();
        $contacts = $this->contactService->getFilteredContacts($request)
            ->paginate(7)
            ->withQueryString();

        return view('auth.admin', compact('contacts', 'categories'));
    }

    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();
        return redirect()->route('admin.index');
    }

    // エクスポート機能の実装
    public function export(Request $request)
    {
        $contacts = $this->contactService->getAllFilteredContacts($request);

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
                $gender = $contact->gender_text;

                $row = [
                    $contact->full_name,
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