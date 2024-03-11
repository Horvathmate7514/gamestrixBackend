<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

/**
 * @SWG\Get(
 *     path="/categories",
 *     summary="Get a list of users",
 *     tags={"Category"},
 *     @SWG\Response(response=200, description="Successful operation"),
 *     @SWG\Response(response=400, description="Invalid request"),
 * )

 */
class CategoriesController extends Controller
{
    /**
 * @OA\Info(title="My First API", version="0.1")
 * @OA\Get(
 *     path="/api/categories",
 *     @OA\Response(response="200", description="Display a listing of projects.")
 * )
 */
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
