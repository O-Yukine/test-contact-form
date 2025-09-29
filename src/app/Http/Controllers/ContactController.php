<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;



class ContactController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('index', compact('categories'));
    }

    public function confirm(Request $request)
    {

        $contact = $request->only(['first_name', 'last_name', 'gender', 'email', 'tel1', 'tel2', 'tel3', 'address', 'building', 'category_id', 'detail']);
        $content = $request->input('category_id');
        $category = Category::find($content);

        return view('confirm', compact('contact', 'category'));
    }
}
