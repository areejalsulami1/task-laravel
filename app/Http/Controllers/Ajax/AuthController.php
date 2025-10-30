<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Models\LogEntry;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request){
        $request->validate(['username'=>'required','password'=>'required']);

        $user = User::where('username',$request->username)->first();
        if(!$user) return response()->json(['status'=>'error','message'=>'User not found'],404);
        if(!Hash::check($request->password,$user->password))
            return response()->json(['status'=>'error','message'=>'Wrong password'],401);

        Auth::login($user);
        LogEntry::create(['user_id'=>$user->id,'action'=>'login','details'=>'User logged in via AJAX']);
        return response()->json(['status'=>'success','message'=>'Login successful']);
    }

    public function logout(){
        if(auth()->id()){
            LogEntry::create(['user_id'=>auth()->id(),'action'=>'logout','details'=>'User logged out']);
        }
        Auth::logout();
        return response()->json(['status'=>'success']);
    }
}
