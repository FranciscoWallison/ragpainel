<?php

namespace App\Http\Controllers\User\Auth;

use App\Mail\NewUser;
use App\Mail\RequestLogin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class RequestLoginController extends Controller
{
    public function index()
    {
        return view('user.request-login');
    }

    public function send(Request $request)
    {
        $validator = Validator::make($request->only('email'), [
            'email' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect('request-login')
                ->withErrors($validator)
                ->withInput();
        }

        $email = User::select('userid', 'email')->where('email', $request->input('email'))->first();

        if(!empty($email))
        {
            Mail::to($email)->send(new RequestLogin($email));
            return back()->with('success', 'O seu login foi enviado para o e-mail cadastrado com sucesso.');

        } else {
            return back()->with('alert', 'Esse e-mail não pertence a nenhuma conta.');
        }

    }
}
