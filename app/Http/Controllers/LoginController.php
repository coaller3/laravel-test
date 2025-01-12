<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //
    public function login(Request $request)
    {
        // return response()->json(['status'=>"failed", 'request'=>$request->all()], 500);

        $email = $request->email;
        $password = $request->password;

        $credentials = $request->validate([
            'email' => 'required|string|email|max:255',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = User::where('email', $email)->where('status', 'ACTIVE')->first();

            if ($user) {
                if (Hash::check($password, $user->password)) {

                    return redirect("/products");

                }
            }
        }

        return redirect('/')->with('status', 'failed');
    }

    public function logout()
    {
        session()->flush();
        return redirect('/');
    }
}
