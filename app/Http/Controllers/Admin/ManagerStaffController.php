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

class ManagerStaffController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.managerstaff', [
            'findstaff' => null,
            'findlogin' => null
        ]);

    }

    public function add(Request $request){

        $validator = Validator::make($request->only('login', 'staffadd'), [
            'login' => 'required|min:4|max:10',
            'staffadd' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('/admin/managerstaff')
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::where('userid', $request->input('login'))->first();

        if($user) {
            if($request->input('staffadd') == 1){
                $user->group_id = 99;
                $user->save();
                return back()->with('custom_alert_success', 'Membro '.$request->input('login').' adicionado ao cargo de Administrador.');
            }
            if($request->input('staffadd') == 2){
                $user->group_id = 50;
                $user->save();
                return back()->with('custom_alert_success', 'Membro '.$request->input('login').' adicionado ao cargo de Game Master.');
            }
            if($request->input('staffadd') == 3){
                $user->group_id = 20;
                $user->save();
                return back()->with('custom_alert_success', 'Membro '.$request->input('login').' adicionado ao cargo de Community Manager.');
            }
        } else {
            return back()->with('custom_alert', 'Usuário não encontrado.');
        }
    }

    public function remove(Request $request){

        $validator = Validator::make($request->only('login', 'staffremove'), [
            'login' => 'required|min:4|max:10',
            'staffremove' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return redirect('/admin/managerstaff')
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::where('userid', $request->input('login'))->first();

        if($user) {
            $user->group_id = 0;
            $user->save();
            return back()->with('custom_alert', 'Membro '.$request->input('login').' removido da equipe com sucesso.');
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
            if($user->group_id == 99){
                $staff = "Administrador";
            }
            if($user->group_id == 50){
                $staff = "Game Master";
            }
            if($user->group_id == 20){
                $staff = "Comunnity Manager";
            }
            if($user->group_id <= 10){
                $staff = "Não faz parte da equipe.";
            }
            return view('admin.managerstaff', [
                'findlogin' => $user->userid,
                'findstaff' => $staff
            ]);
        } else {
            return back()->with('custom_alert', 'Usuário não encontrado.');
        }

    }
}
