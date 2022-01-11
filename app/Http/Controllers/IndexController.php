<?php

namespace App\Http\Controllers;

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
use App\Http\Controllers\Admin\ConfigController;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewUser;

class IndexController extends Controller
{
    public function index(Request $request)
    {

        $onlineList = Char::select('name')->where('online', '>=', 1)->get();
        $onlineCount = count($onlineList);

        $userCount = User::count();

        $charCount = Char::count();

        $guildCount = Guild::count();

        $np = 0;
        $nw = 0;
        $nm = 0;

        $topPVP = RankingPVP::select('char_name', 'point')->orderByDesc('point')->limit(3)->get();

        $topGVG = RankingGVG::select('guild_name', 'point')->orderByDesc('point')->limit(3)->get();

        $topMVP = Char::select('name', 'mvps')->orderByDesc('mvps')->limit(3)->get();

            return view('index', [
                'charsOnline' => $onlineCount,
                'userCount' => $userCount,
                'charCount' => $charCount,
                'guildCount' => $guildCount,
                'topPVP' => $topPVP,
                'topGVG' => $topGVG,
                'topMVP' => $topMVP,
                'np' => $np,
                'nw' => $nw,
                'nm' => $nm
            ]);
        }
}
