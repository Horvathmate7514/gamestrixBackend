<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();

        return response()->json($products);

    }

    protected function productsById($id){
        $categories = Category::find($id);
        // foreach ($products as $product){
        //     $p[]= [
        //         $name = $product->ProductName,
        //         $description = $product->ProductDescription,
        //         $price = $product->RetailPrice,
        //         $img = $product->Image,

        //     ];
            return response()->json($categories->products,200);

}
protected function productsSingleOne($id){
    $product = Product::where('ProductNumber', $id)->first();

    if(!$product) {
      return response()->json([
        'message' => 'Product not found'
      ], 404);
    }

    return response()->json($product);

}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $productsByCategories = Product::where('CategoryID','=',$id)->get();

        if ($productsByCategories == null)
            return response()->json(['message' => 'No item found.'], 404);

        return response()->json($productsByCategories);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
