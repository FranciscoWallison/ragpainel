<?php

namespace App\Http\Controllers\Rankings;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Char;
use Illuminate\Support\Facades\DB;

class MVPController extends Controller
{
    public function index(Request $request)
    {

        $n = 1;

        $rankingMVP = DB::select("SELECT c.name as char_name, c.mvps, g.name as guild_name FROM `char` AS c LEFT JOIN guild AS g ON c.char_id = g.char_id ORDER BY mvps DESC");

            return view('rankings.mvp', [
                'rankingMVP' => $rankingMVP,
                'n' => $n
            ]);
    }
}
