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

        return view('contact.index', compact('categories'));
    }

    public function confirm(ContactRequest $request)
    {
        $inputs = $request->all();

        $category = Category::find($inputs['content']);

        return view('contact.confirm', compact('inputs', 'category'));
    }

    public function store(ContactRequest $request)
    {
        $inputs = $request->all();

        $genderMap = [
            'male' => 1,
            'female' => 2,
            'other' => 3,
        ];

        Contact::create([
            'first_name' => $inputs['first_name'],
            'last_name' => $inputs['last_name'],
            'gender' => $genderMap[$inputs['gender']],
            'email' => $inputs['email'],
            'tell' => $inputs['phone1'] . $inputs['phone2'] . $inputs['phone3'],
            'address' => $inputs['address'],
            'building' => $inputs['building'] ?? null,
            'category_id' => $inputs['content'],
            'detail' => $inputs['detail'],
        ]);

        return redirect()->route('contact.thanks');
    }

    public function edit(Request $request)
    {
        $inputs = $request->all();

        return redirect()->route('contact.index')->withInput($inputs);
    }

    public function thanks()
    {
        return view('contact.thanks');
    }
}
