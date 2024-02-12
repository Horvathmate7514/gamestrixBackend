<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;


class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Category::all();


        // $categories = DB::table('categories')->get();
        return response()->json($categories);
    }


    public function show($id)
    {
        $categories = Category::where('CategoryID','=',$id)->get();
        // $categories = Category::with('category')->find($id);
        if ($categories == null)
            return response()->json(['message' => 'No item found.'], 404);

        return response()->json($categories);
        // return BookResource::make($book);
        // return response()->json($book);
    }
}
