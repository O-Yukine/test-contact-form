<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Contact;

class FortifyController extends Controller
{
    public function index()
    {
        $contacts = Contact::with('category')->Paginate(7);
        $categories = Category::all();

        return view('admin', compact('contacts', 'categories'));
    }
}
