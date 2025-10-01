<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Contact;

class FortifyController extends Controller
{
    public function index(Request $request)
    {
        $contacts = Contact::with('category')
            ->KeywordSearch($request->input('keyword'))
            ->GenderSearch($request->input('gender'))
            ->CategorySearch($request->input('category_id'))
            ->CreatedSearch($request->input('created_at'))
            ->paginate(7);
        $categories = Category::all();

        return view('admin', compact('contacts', 'categories'));
    }
}
