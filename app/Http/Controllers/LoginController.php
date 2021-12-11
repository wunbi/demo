<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{

    public function doLogin(Request $request)
    {
        if (!$user = User::firstWhere('account', trim($request->get('account')))) {
            return back()->with('error', 'login fail!');
        }

        if ($user->password != Hash::make(trim($request->get('password')))) {
            return back()->with('error', 'login fail!');
        }

        Auth::login($user);
        return redirect()->route('index');
    }
}
