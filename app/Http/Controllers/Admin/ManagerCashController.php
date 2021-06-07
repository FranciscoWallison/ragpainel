<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\User\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Database;
use App\Models\Char;
use App\Models\Guild;
use App\Models\RankingPVP;
use App\Models\RankingGVG;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ManagerCashController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.managercash', [
            'findcash' => null,
            'findlogin' => null
        ]);

    }

    public function add(Request $request){

        $validator = Validator::make($request->only('login', 'cashadd'), [
            'login' => 'required|min:4|max:10',
            'cashadd' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return redirect('/admin/managercash')
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::where('userid', $request->input('login'))->first();

        if($user) {
            $user->cash += $request->cashadd;
            $user->save();
            return back()->with('custom_alert_success', 'Créditos adicionados com sucesso na conta: '.$request->input('login').'.');
        } else {
            return back()->with('custom_alert', 'Usuário não encontrado.');
        }

    }

    public function remove(Request $request){

        $validator = Validator::make($request->only('login', 'cashremove'), [
            'login' => 'required|min:4|max:10',
            'cashremove' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return redirect('/admin/managercash')
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::where('userid', $request->input('login'))->first();

        if($user) {
            $user->cash -= $request->cashremove;
            $user->save();
            return back()->with('custom_alert', 'Créditos removidos com sucesso na conta: '.$request->input('login').'.');
        } else {
            return back()->with('custom_alert', 'Usuário não encontrado.');
        }

    }

    public function find(Request $request){

        $validator = Validator::make($request->only('login'), [
            'login' => 'required|min:4|max:10',
        ]);

        if ($validator->fails()) {
            return redirect('/admin/managercash')
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::where('userid', $request->input('login'))->first();

        if($user) {
                return view('admin.managercash', [
                    'findlogin' => $user->userid,
                    'findcash' => $user->cash
                ]);
        } else {
            return back()->with('custom_alert', 'Usuário não encontrado.');
        }

    }
}
