<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Validator;
use Auth;

class AuthController extends Controller
{
    public function signup(Request $request){
        
        $validator = Validator::make($request->all(), [ 
            'name' => 'required|string|max:255',
            'class' => 'required|integer|between:1,12',
            'phone_number' => 'required|numeric|unique:users,phone_number',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()){ 
            $message = $validator->errors()->first();
            return response()->json(['message' => $message], 401);            
        }


        $user = User::create([
            'name' => $request->name,
            'class' => $request->class,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'message' => 'Registration Successful',
            'data' => [
                'user_id' => $user->id,
                'name' => $user->name,
            ],
        ], 201);
    }

    public function login(Request $request){

        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()){ 
            $message = $validator->errors()->first();
            return response()->json(['message' => $message], 401);            
        }

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Login Successful',
            'token' => $token,
        ]);
    }

    public function logout(Request $request){

        Auth::logout();

        return response()->json([
            'message' => 'Logout Successful',
        ]);
    }
}
