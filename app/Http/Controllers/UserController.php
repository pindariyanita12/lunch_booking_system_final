<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UserController extends Controller
{
    public function login(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $user = User::where('email', $request->email)->where('password',$request->password)->first();
        if (!$user) {
            return response([
                'message' => 'User Not Found',
            ], 401);
        }
        $user->is_active=1;
        $user->save();
        $token = $user->createToken('myToken')->plainTextToken;
        return response([
            'token' => $token,
             'id'=>$user->id
        ], 200);

    }
    public function logout(Request $request)
    {

        $request->validate([
            'user_id' => 'required',

        ]);
        $user = User::where('id', $request->user_id)->first();
        if (!$user) {
            return response([
                'message' => 'User Not Found',
            ], 401);
        }
        $user->is_active=0;
        $user->save();
        return response([
             'message'=>'Successfully Logout',
        ], 200);

    }

}
