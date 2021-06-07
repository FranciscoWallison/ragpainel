<?php

namespace App\Http\Controllers\Rankings;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\RankingPVP;
use App\Http\Controllers\Controller;

class PVPController extends Controller
{
    public function index(Request $request)
    {
        $n = 1;

        $rankingPVP = RankingPVP::select('char_name', 'matou', 'morreu', 'total')->orderByDesc('total')->limit(50)->get();

            return view('rankings.pvp', [
                'rankingPVP' => $rankingPVP,
                'n' => $n
            ]);
    }
}
