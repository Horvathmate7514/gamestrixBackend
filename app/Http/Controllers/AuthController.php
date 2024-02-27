<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(LoginRequest $request){
        $request->validated();

       if (!Auth::attempt($request->only('email', 'password')))
       {
            return response()->json([
               'message' => 'Invalid credentials'
            ], 401);
       }

       $user = User::where('email', $request->email)->first();

       $data = [
        'user' => $user,
        'token' => $user->createToken('token')->plainTextToken
    ];

    return response()->json($data, 200);

    }

    public function logout(){
        Auth::user()->currentAccessToken()->delete();

        return response()->json(["message" => "Logged out"], 200);
    }

    public function register(RegisterRequest $request){
        $request->validated();

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'adress' => $request->adress,
            'phone_number' => $request->phone_number,
            'role' => 0
        ]);


        $data = [
            'user' => $user,
            'token' => $user->createToken('token')->plainTextToken
        ];

        return response()->json($data, 201);

    }
}
