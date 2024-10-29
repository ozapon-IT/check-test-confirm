<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use App\Models\Category;

class ContactController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return view('contacts.index', compact('categories'));
    }

    public function confirm(ContactRequest $request)
    {
        $inputs = $request->all();

        $category = Category::find($inputs['content']);

        return view('contacts.confirm', compact('inputs', 'category'));
    }

    public function store(ContactRequest $request)
    {
        $inputs = $request->all();

        Contact::create([
            'first_name' => $inputs['first_name'],
            'last_name' => $inputs['last_name'],
            'gender' => $inputs['gender'],
            'email' => $inputs['email'],
            'tell' => $inputs['phone1'] . $inputs['phone2'] . $inputs['phone3'],
            'address' => $inputs['address'],
            'building' => $inputs['building'] ?? null,
            'category_id' => $inputs['content'],
            'detail' => $inputs['detail'],
        ]);

        return redirect()->route('contacts.thanks');
    }

    public function edit(Request $request)
    {
        $inputs = $request->all();

        return redirect()->route('contacts.index')->withInput($inputs);
    }

    public function thanks()
    {
        return view('contacts.thanks');
    }
}
