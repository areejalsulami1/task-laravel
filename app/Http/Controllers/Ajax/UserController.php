<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Models\LogEntry;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
   

    public function index(){
        return response()->json(
            User::select('id','username','name','age','email','created_at')->orderBy('id','desc')->get()
        );
    }

    public function store(Request $request){
        $data = $request->validate([
            'username'=>'required|string|unique:users,username',
            'name'=>'nullable|string|max:100',
            'age'=>'nullable|integer|min:0',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|string|min:6'
        ]);
        $data['password']=Hash::make($data['password']);
        $user = User::create($data);

        LogEntry::create(['user_id'=>auth()->id(),'action'=>'add_user','details'=>"Added user #{$user->id} ({$user->username})"]);
        return response()->json(['status'=>'success','user'=>$user]);
    }

    public function update(Request $request, User $user){
        $data = $request->validate([
            'username'=>"sometimes|required|string|unique:users,username,{$user->id}",
            'name'=>'sometimes|nullable|string|max:100',
            'age'=>'sometimes|nullable|integer|min:0',
            'email'=>"sometimes|required|email|unique:users,email,{$user->id}",
            'password'=>'sometimes|nullable|string|min:6'
        ]);

        if(isset($data['password']) && $data['password']){
            $data['password']=Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);
        LogEntry::create(['user_id'=>auth()->id(),'action'=>'edit_user','details'=>"Edited user #{$user->id}"]);
        return response()->json(['status'=>'success']);
    }

    public function destroy(User $user){
        $id=$user->id; $uname=$user->username;
        $user->delete();
        LogEntry::create(['user_id'=>auth()->id(),'action'=>'delete_user','details'=>"Deleted user #{$id} ({$uname})"]);
        return response()->json(['status'=>'success']);
    }
}
