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

class LogsController extends Controller
{
    public function index(Request $request)
    {
        // PVP LOGS.
        $pvplogs = DB::table('ranking_pvp_logs')->select('id', 'assassin', 'target', 'created_at')->orderByDesc('created_at')->get();

        // Comandos LOGS.
        $commandslogs = DB::table('atcommandlog')->select('atcommand_id', 'atcommand_date', 'char_name', 'map', 'command')->orderByDesc('atcommand_date')->get();

        // Chat LOGS.
        $chatlogs = DB::table('chatlog')->select('id', 'time', 'src_map', 'src_map_x', 'src_map_y', 'dst_charname', 'message')->orderByDesc('time')->get();

        // Guild LOGS.
        $guildlogs = DB::table('interlog')->select('id', 'time', 'log')->orderByDesc('time')->get();

        // Login LOGS
        $loginlogs = DB::table('loginlog')->select('time', 'ip', 'user', 'log')->orderByDesc('time')->get();

        // Drops LOGS
        $dropslogs = DB::table('picklog')->select('id', 'time', 'nameid', 'amount')->orderByDesc('time')->get();

        return view('admin.logs', [
        'pvplogs' => $pvplogs,
        'commandslogs' => $commandslogs,
        'chatlogs' => $chatlogs,
        'guildlogs' => $guildlogs,
        'loginlogs' => $loginlogs,
        'dropslogs' => $dropslogs
        ]);
    }
}
