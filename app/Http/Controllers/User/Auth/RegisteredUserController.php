<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use App\Mail\NewUser;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\Contracts\Foundation\Application
     */
    public function index()
    {
        return view('user.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->only('userid', 'email', 'password', 'password_confirmation'), [
            'userid' => 'required|min:4|max:10|unique:login,userid',
            'email' => 'required|unique:login,email',
            'password' => 'required|min:8|confirmed'
        ]);

        if ($validator->fails()) {
            return redirect('register')
                ->withErrors($validator)
                ->withInput();
        }

        $user = new User;
        $user->userid = $request->userid;
        $user->email = $request->email;
        $user->user_pass = $request->password;
        $user->save();

        Auth::login($user);
        Mail::to(\Auth::user()->email)->send(new NewUser(\Auth::user()));
        return redirect()->route('index');
    }
}
