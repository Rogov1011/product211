<?php

namespace App\Http\Controllers;

use App\Mail\RegisterSuccessmMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function registerPage()
    {
        return view('auth.register');
    }

    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => 'required|min:2',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'password_confirmation' => "same:password"
        ]);
        $user = User::create([
            'name' => $request->input("name"),
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        Mail::to($user->email)->send(new RegisterSuccessmMail($user));

        return redirect()
            ->route("auth.loginPage")
            ->with("success_register", "Вы успешно зарегистрированны!!! Теперь войдите в аккуант.");
    }

    public function loginPage()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentional = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if (Auth::attempt($credentional)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }
        return back()->withErrors([
            'email' => 'логин или пароль введен не верно'
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
