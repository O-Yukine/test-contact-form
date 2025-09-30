<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Contact;
use App\Http\Requests\ContactRequest;


class ContactController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();

        if ($request->isMethod('post')) {
            return redirect('/')
                ->withInput();
        }

        return view('index', compact('categories'));
    }

    public function confirm(ContactRequest $request)
    {

        $contact = $request->only(['first_name', 'last_name', 'gender', 'email', 'tel1', 'tel2', 'tel3', 'address', 'building', 'detail']);
        $content = $request->input('category_id');
        $category = Category::find($content);

        return view('confirm', compact('contact', 'category'));
    }

    public function store(ContactRequest $request)
    {
        $contact = $request->only(['first_name', 'last_name', 'gender', 'email', 'tel', 'address', 'building', 'category_id', 'detail']);
        Contact::create($contact);

        return view('/thanks');
    }
}
