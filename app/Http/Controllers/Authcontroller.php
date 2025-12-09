<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Authcontroller extends Controller
{
      
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
