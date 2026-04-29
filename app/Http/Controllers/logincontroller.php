<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Staff;

class LoginController extends Controller
{
    public function showLogin()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $user = Staff::where('username', $request->username)
                     ->where('password', $request->password)
                     ->first();

        if ($user) {
            session([
                'admin_logged_in' => true,
                'staff_name' => $user->name,
                'staff_role' => $user->role
            ]);

            return redirect('/orders');
        }

        return back()->with('error', 'Invalid Login');
    }

    public function logout()
    {
        session()->flush();
        return redirect('/login');
    }
}