<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactService
{
    // フィルタリングロジック
    public function getFilteredContacts(Request $request)
    {
        $query = Contact::with('category')
            ->keywordFilter($request->input('keyword'))
            ->genderFilter($request->input('gender'))
            ->categoryFilter($request->input('category'))
            ->dateFilter($request->input('date'));

        return $query;
    }

    // エクスポート用にすべてのデータを取得するメソッド
    public function getAllFilteredContacts(Request $request)
    {
        return $this->getFilteredContacts($request)->get();
    }
}