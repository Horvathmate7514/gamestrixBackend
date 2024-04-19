<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function getProductsWithPage()
    {
        $products = Product::paginate(10);

        return response()->json($products);
    }

    protected function productsById($id)
    {
        $categories = Category::find($id);
        return response()->json($categories->products, 200);
    }
    protected function productsSingleOne($id)
    {
        $product = Product::where('ProductNumber', $id)->first();

        if (!$product) {
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
        if (Auth::user()->role != 1) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        $product = Product::create([
            'ProductName' => $request->ProductName,
            'ProductDescription' => $request->ProductDescription,
            'RetailPrice' => $request->RetailPrice,
            'QuantityOnHand' => $request->QuantityOnHand,
            'CategoryID' => $request->CategoryID,
            'Image' => $request->Image,
        ]);
        return response()->json($product, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $productsByCategories = Product::where('CategoryID', '=', $id)->get();

        if ($productsByCategories == null)
            return response()->json(['message' => 'No item found.'], 404);

        return response()->json($productsByCategories);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {


    }

    public function updateProduct(Request $request, $id)
    {
        if (Auth::user()->role != 1) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $product = Product::findOrFail($id);

        $product->ProductName = $request->ProductName;
        $product->ProductDescription = $request->ProductDescription;
        $product->RetailPrice = $request->RetailPrice;
        $product->QuantityOnHand = $request->QuantityOnHand;
        $product->CategoryID = $request->CategoryID;
        $product->Image = $request->Image;

        $product->save();

        return response()->json([
            'message' => 'Product updated successfully',
            'product' => $product
        ], 200);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        if (Auth::user()->role != 1) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        $deleteProduct = Product::where('ProductNumber', '=', $id)->delete();

        if (!$deleteProduct) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        return response()->json(['message' => 'Product deleted']);
    }
}
