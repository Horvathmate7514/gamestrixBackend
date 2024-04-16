<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function makeOrder(Request $request)
    {
        $order = Order::create([
            'OrderDate' => now(),
            'ShipDate' => now()->addDays(7),
            'CustomerID' => Auth::id(),
            // 'Total' => OrderDetails::where('OrderNumber', $request->OrderNumber)->sum('QuotedPrice'),


        ]);
         $order->Total=0;

        foreach ($request->all() as $product) {

            OrderDetails::create([
                'OrderNumber' => $order->OrderNumber,
                'ProductNumber' => $product["ProductNumber"],
                'QuantityOrdered' => $product["QuantityOrdered"],
                'QuotedPrice' => $product["QuotedPrice"],
                // $Total =>$product["QuantityOrdered"] * $product["QuotedPrice"],
            ]);
            $order->Total += $product["QuotedPrice"] * $product["QuantityOrdered"];


        }
        $order->save();

        return response()->json($order, 201);

        // return $request->all();

    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
