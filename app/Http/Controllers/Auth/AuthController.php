<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Client;
use App\Models\User;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login'); // You can keep a single login view for users
    }
    public function index()
    {
        return view('auth.login');
    }

    public function registration()
    {
        return view('auth.registration');
    }
    public function postLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->hasRole('Client')) {
                return view('pages.auth.client-dashboard');
            } else {
                return redirect()->intended('dashboard')
                    ->with('success', 'You have successfully logged in');
            }
        }

        return redirect("login")->with('error', 'Oops! Invalid credentials');
    }

        public function postRegistration(Request $request)
        {
            $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:6',
            ]);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);
            Client::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'tanggal_lahir' => '1999-80-23',
                'no_hp' => '09283012',
                'alamat' => 'Palemabang'
            ]);

            $user->assignRole('Client');

            return redirect("login")->with('success', 'Great! You have successfully registered and logged in');
        }


    public function dashboard()
    {
        if (Auth::check()) {
            return view('auth.dashboard');
        }



        return redirect("login")->with('error', 'Oops! You do not have access');
    }

    public function logout()
    {
        Auth::logout();

        return redirect('login');
    }
}
