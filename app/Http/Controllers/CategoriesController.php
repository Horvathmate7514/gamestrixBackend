<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        // $categories = Category::with('books')->get();
        return response()->json($categories);
    }


    public function show($id)
    {
        $categories = Category::where('CategoryID','=',$id)->get();
        // $book = Category::with('category')->find($id);
        if ($categories == null)
            return response()->json(['message' => 'No book found.'], 404);

        return response()->json($categories);
        // return BookResource::make($book);
        // return response()->json($book);
    }
}
