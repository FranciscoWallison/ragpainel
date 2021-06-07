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
use App\Http\Controllers\Admin\ManagerBanController;

class ManagerBanController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.managerban', [
            'findban' => null,
            'findlogin' => null
        ]);

    }

    public function add(Request $request){

        $validator = Validator::make($request->only('login', 'staffadd'), [
            'login' => 'required|min:4|max:10',
        ]);

        if ($validator->fails()) {
            return redirect('/admin/managerban')
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::where('userid', $request->input('login'))->first();

        if($user) {
                $user->state = 5;
                $user->save();
                return back()->with('custom_alert', 'Conta '.$request->input('login').' banida com sucesso.');
            } else {
            return back()->with('custom_alert', 'Usuário não encontrado.');
        }
    }

    public function remove(Request $request){

        $validator = Validator::make($request->only('login', 'staffremove'), [
            'login' => 'required|min:4|max:10',
        ]);

        if ($validator->fails()) {
            return redirect('/admin/managerstaff')
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::where('userid', $request->input('login'))->first();

        if($user) {
            $user->state = 0;
            $user->save();
            return back()->with('custom_alert_success', 'Conta de login '.$request->input('login').' desbanida com sucesso.');
        } else {
            return back()->with('custom_alert', 'Usuário não encontrado.');
        }

    }

    public function find(Request $request){

        $validator = Validator::make($request->only('login'), [
            'login' => 'required|min:4|max:10',
        ]);

        if ($validator->fails()) {
            return redirect('/admin/managerstaff')
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::where('userid', $request->input('login'))->first();

        if($user) {
            if($user->state == 5){
                $status = "Banida Permanentemente";
            }
            if($user->state == 0){
                $status = "Conta Regular";
            }
            return view('admin.managerban', [
                'findlogin' => $user->userid,
                'findban' => $status
            ]);
        } else {
            return back()->with('custom_alert', 'Usuário não encontrado.');
        }

    }
}
