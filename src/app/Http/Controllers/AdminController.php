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
        $query = Contact::query()->with('category');

        // 名前またはメールアドレスでの検索（部分一致・完全一致対応）
        if ($request->filled('keyword')) {
            $keyword = trim($request->input('keyword'));
            $matchType = $request->input('match_type', 'partial');

            $query->where(function ($q) use ($keyword, $matchType) {
                if ($matchType === 'exact') {
                    // 完全一致検索: 大文字小文字を無視して比較
                    $q->whereRaw('LOWER(first_name) = ?', [mb_strtolower($keyword)])
                    ->orWhereRaw('LOWER(last_name) = ?', [mb_strtolower($keyword)])
                    ->orWhereRaw('LOWER(email) = ?', [mb_strtolower($keyword)]);
                } else {
                    // 部分一致検索
                    $q->where('first_name', 'like', '%' . $keyword . '%')
                    ->orWhere('last_name', 'like', '%' . $keyword . '%')
                    ->orWhere('email', 'like', '%' . $keyword . '%');
                }

            // $query->where(function ($q) use ($keyword, $matchType) {
            //     $operator = $matchType === 'exact' ? '=' : 'like';
            //     $searchTerm = $matchType === 'exact' ? $keyword : '%' . $keyword . '%';

            //     $q->where('first_name', $operator, $searchTerm)->orWhere('last_name', $operator, $searchTerm)->orWhere('email', $operator, $searchTerm);
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

        $contacts = $query->paginate(7);
        $categories = Category::all();

        return view('admin', compact('contacts', 'categories'));
    }
}
