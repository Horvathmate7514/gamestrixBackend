<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

    public function updateProfile(Request $request)
    {

        $user = Auth::user();

        $currentPassword = $request->input('current_password');

        if (!Hash::check($currentPassword, $user->password)) {
            return response()->json(['message' => 'Current password is incorrect'], 422);
        }

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->adress = $request->input('adress');
        $user->phone_number = $request->input('phone_number');

        if ($request->filled('new_password')) {
            $user->password = Hash::make($request->input('new_password'));
        }
        $user->save();


        return response()->json($user, 200);
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

