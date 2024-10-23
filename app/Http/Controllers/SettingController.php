<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SettingController extends Controller
{
    public function account()
    {
        return view('settings.account');
    }

    public function updateAccount(Request $request)
    {
        $request->validate($request, [
            'name' =>'required',
            'email' =>'required|email|unique:users,email,' . auth()->user()->id,
            'current_password' => 'nullable|current_password:web',
            'password' => 'nullable|confirmed|min:6',
        ]);

        $user = auth()->user();
        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->password) {
            $user->password =  Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('settings.account')->with('success', 'Your account has been updated');
    }
}
