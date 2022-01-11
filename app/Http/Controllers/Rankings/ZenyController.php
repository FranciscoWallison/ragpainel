<?php

namespace App\Http\Controllers\Rankings;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\RankingGVG;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ZenyController extends Controller
{
    public function index(Request $request)
    {

        $n = 1;

        $rankingZeny = DB::select("SELECT c.name as char_name, c.zeny, g.name as guild_name FROM `char` AS c LEFT JOIN guild AS g ON c.char_id = g.char_id ORDER BY zeny DESC");

            return view('rankings.zeny', [
                'rankingZeny' => $rankingZeny,
                'n' => $n
            ]);
        }
}
