<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class Authcontroller extends Controller
{
        public function register(Request $request)
    {
       // dd('log');
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
        ]);

//dd('log');

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }


        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        
       // dd('log');
        return response()->json([
            'message' => 'User registered successfully',
            'user'    => $user,


        ]);
    }
public function login(Request $request)
{
    $credentials = $request->only('email','password');

    if(!Auth::attempt($credentials)){
        return response()->json(['message' => 'Invalid login'], 401);
    }
// dd('log');
    $user = Auth::user();

  //dd('log');
    $employee = Employee::where('user_id', $user->id)->first();

    return response()->json([
      
        'token' =>  $user->createToken('UserToken')->accessToken,
        'user' => $user,
        'employee' => $employee
    ]);
}

public function user()  {
    $user = Auth::user();
    return response()->json([
        'user' => $user
        ]);
}
}
