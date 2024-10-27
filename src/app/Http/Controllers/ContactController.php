<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use App\Models\Category;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();

        $inputs = $request->session()->get('inputs');

        return view('contact.index', compact('categories', 'inputs'));
    }

    public function confirm(ContactRequest $request)
    {
        $inputs = $request->all();

        $request->session()->put('inputs', $inputs);

        return view('contact.confirm', compact('inputs'));
    }

    public function store(Request $request)
    {
        $inputs = $request->session()->get('inputs');

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

        $request->session()->forget('inputs');

        return redirect()->route('contact.thanks');
    }

    public function thanks()
    {
        return view('contact.thanks');
    }
}
