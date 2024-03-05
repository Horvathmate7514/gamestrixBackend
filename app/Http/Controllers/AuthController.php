<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Mail\ResetTokenEmail;
use App\Models\PasswordResetToken;
use App\Models\ResetPasswordToken;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

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

    public function ResetPasswordToken(Request $request) {

      $user =  User::where('email', $request->email)->first();
        if (!$user)
        {
            return response()->json(['message' => 'User not found'], 404);
        }

        $tokenUser = (PasswordResetToken::where('email', $user->email)->first());

        if ($tokenUser){
            $expired = Date("Y-m-d H:i", strtotime("15 minutes", strtotime($tokenUser->created_at))); /// 15 perces reset token !!!
            $time = Date("Y-m-d H:i", strtotime("60 minutes", strtotime(now())));

            if ($time < $expired){
                return response()->json(["error" => true, "message" => "Email already sent."], 404);
            }
            PasswordResetToken::where('email', $user->email)->delete();
        }






        if (PasswordResetToken::where('email', $user->email)->first()){
            return response()->json(['message' => 'Email already sent'], 404);
        }


        $resetToken=  PasswordResetToken::updateOrCreate([
            'email' => $user->email,
            'token' => Str::random(60)

        ]);


        $text = 'Reset Password';
        $resetLink = $resetToken->token;



        Mail::to($user->email.'
        ')->send(new ResetTokenEmail($text, $resetLink));



        return response()->json(['message' => 'Reset token sent'], 200);
    }

    public function ResetPassword(Request $request) {

       $tokenUser = PasswordResetToken::where('token', $request->token)->first();

        if (!$tokenUser){
            return response()->json(['message' => 'Token not found'], 404);
        }

       $user = User::where('email', $tokenUser->email)->first();

       $user->password = Hash::make($request->password);
       $user->save();

       PasswordResetToken::where($request->email)->delete();
       return response()->json(['message' => 'Password has been successfully changed'], 200);

    }
}
