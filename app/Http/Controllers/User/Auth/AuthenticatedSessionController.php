<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Http\Controllers\IndexController;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\Contracts\Foundation\Application|
     */
    public function index()
    {

        if (Auth::check()) {
            return  redirect('/');
        }

        return view('user.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function authenticate(Request $request)
    {

        $validator = Validator::make($request->only('userid', 'password'), [
            'userid' => 'required|min:4',
            'password' => 'required|min:8',
        ]);

        if ($validator->fails()) {
            return redirect('login')
                ->withErrors($validator)
                ->withInput();
        }

        $remember = $request->input('remember', false);

        $id = User::where('userid', $request->input('userid'))->where('user_pass', $request->input('password'))->first();

        if(is_null($id)){
            return back()->with('custom_alert', 'Usuário e/ou senha inválido.');
        }

        if($id->state > 0){
            return back()->with('custom_alert', 'Esta conta está banida.');
        }

        if($id) {
            Auth::loginUsingId($id->account_id, $remember);
            $request->session()->regenerate();
            return redirect()->route('index');
        }

    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('user.index.login');
    }
}
