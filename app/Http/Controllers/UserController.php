<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $userStuffs = Order::where('CustomerID', '=', Auth::id())->get();
        return response()->json($userStuffs, 200);

        // $userStuffs = Order::with('products')->where('CustomerID', '=', Auth::id())->get();
        // return response()->json($userStuffs, 200);

        // if ($userStuffs == null) {
        //     return response()->json(['message' => 'User not found'], 404);
        // } else {
        // }
    }


    public function getAllUser()
    {
        if (Auth::user()->role != 1) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        $users = User::with('orders')->get();
        // $orderdetails = Order::with('order')->get();
        return response()->json($users, 200);


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
