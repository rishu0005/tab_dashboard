<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function register(Request $request){
    //    dd($request->all());
       $request->validate([
        'user_name' => 'required|unique:users,name',
        'user_email' => 'required|email|unique:users,email',
        'user_password' => 'required|min:6|confirmed',
       ]);

        $user = new User();
        $user->name = $request->input('user_name');
        $user->email = $request->input('user_email');
        $user->password = Hash::make($request->input('user_password'));
        $user->save();

        return redirect()->back()->with('success', "You have been registered! Welcome in our new family. $user->name!");

    }
}