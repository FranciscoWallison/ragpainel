<?php

namespace App\Http\Controllers\Rankings;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\RankingGVG;
use App\Http\Controllers\Controller;

class GVGController extends Controller
{
    public function index(Request $request)
    {
        $n = 1;

        $rankingGVG = RankingGVG::select('guild_name', 'matou', 'morreu', 'total')->orderByDesc('total')->limit(50)->get();

            return view('rankings.gvg', [
                'rankingGVG' => $rankingGVG,
                'n' => $n
            ]);
    }
}
