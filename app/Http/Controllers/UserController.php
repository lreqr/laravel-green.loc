<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class UserController extends Controller
{
    //Show Register/Create Form
    public function create():View
    {
        return view('users.create');
    }

    //Store User
    public function store(Request $request): RedirectResponse
    {
        $formFields = $request->validate([
            'name' => ['required', 'min:4', Rule::unique('users', 'name')],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'confirmed', 'min:6'],
        ]);

        //Hash Password
        $formFields['password'] = bcrypt($formFields['password']);

        //Create User
        $user = User::create($formFields);

        //Login
        auth()->login($user);

        return redirect(route('index'))->with('message', 'User created and logged in');
    }

    //Logout User
    public function logout(Request $request): RedirectResponse
    {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(route('index'))->with('message', 'You have been logged out');
    }

    //Show Login Form
    public function login(): View
    {
        return view('users.login');
    }

    //Login User
    public function authenticate(Request $request): RedirectResponse
    {
        $formFields = $request->validate([
            'email' => ['required'],
            'password' => ['required'],
        ]);

        if (auth()->attempt($formFields)){
            $request->session()->regenerate();

            return redirect(route('index'))->with('message', 'You are logged in!');
        }

        return back()->withErrors(['email' => 'Invalid Credentials'])->onlyInput('email');
    }

}
