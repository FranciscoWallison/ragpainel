<?php

namespace App\Http\Controllers\User;

use App\Models\Char;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Intervention\Image\ImageManagerStatic as Image;
use App\Models\Guild;
use Illuminate\Support\Facades\DB;

class MyChars extends Controller
{
    public function index(Request $request)
    {

        $id = $request->user()->account_id;

        $chars = DB::select("SELECT c.sex, c.account_id, c.char_id as charid, c.name as char_name, c.class, c.base_level, c.job_level, c.guild_id, c.last_map, g.char_id, g.emblem_id, g.name as guild_name FROM `char` AS c LEFT JOIN guild AS g ON c.char_id = g.char_id  WHERE c.account_id=$id");

        return view('user.mychars', [
            'job' => $this->job(),
            'chars' => $chars,
        ]);
    }

    public function resetPosition(Request $request)
    {
        $reset_char = Char::where('char_id', '=', $request->query('id'))->first();

        $reset_char->last_map = "prontera";
        $reset_char->last_x = 150;
        $reset_char->last_y = 150;
        $reset_char->save();

        return back()->with('custom_alert','Posição do personagem resetada com sucesso.');
    }

    public function resetStyle(Request $request)
    {

        $reset_char = Char::where('char_id', '=', $request->query('id'))->first();

        $reset_char->hair = 1;
        $reset_char->hair_color = 1;
        $reset_char->clothes_color = 1;
        $reset_char->body = 0;
        $reset_char->save();

        return back()->with('custom_alert','Estilo do personagem resetado com sucesso.');
    }

    public function job(){
        $job = [
            0    => 'Aprendiz',
            1    => 'Espadachim',
            2    => 'Mago',
            3    => 'Arqueiro',
            4    => 'Noviço',
            5    => 'Mercador',
            6    => 'Gatuno',
            7    => 'Cavaleiro',
            8    => 'Sacerdote',
            9    => 'Bruxo',
            10   => 'Ferreiro',
            11   => 'Caçador',
            12   => 'Assassino',
            14   => 'Templário',
            15   => 'Monge',
            16   => 'Sábio',
            17   => 'Arruaceiro',
            18   => 'Alquimista',
            19   => 'Bardo',
            20   => 'Dancarina',
            23   => 'Super Aprendiz',
            24   => 'Justiceiro',
            25   => 'Ninja',

            4001 => 'S. Aprendiz',
            4002 => 'S. Cavaleiro',
            4003 => 'S. Mago',
            4004 => 'S. Arqueiro',
            4005 => 'S. Noviço',
            4006 => 'S. Mercador',
            4007 => 'S. Gatuno',
            4008 => 'Lorde',
            4009 => 'Sumo Sacerdote',
            4010 => 'Arquimago',
            4011 => 'Mestre-Ferreiro',
            4012 => 'Atirador de Elite',
            4013 => 'Algoz',
            4015 => 'Paladino',
            4016 => 'Mestre',
            4017 => 'Professor',
            4018 => 'Desordeiro',
            4019 => 'Criador',
            4020 => 'Bardo',
            4021 => 'Odalisca',
            4023 => 'Bebê',
            4024 => 'Bebê Espadachim',
            4025 => 'Bebê Mago',
            4026 => 'Bebê Arqueiro',
            4027 => 'Bebê Noviço',
            4028 => 'Bebê Mercador',
            4029 => 'Bebê Gatuno',
            4030 => 'Bebê Cavaleiro',
            4031 => 'Bebê Sacerdote',
            4032 => 'Bebê Bruxo',
            4033 => 'Bebê Ferreiro',
            4034 => 'Bebê Caçador',
            4035 => 'Bebê Assassino',
            //4036 => 'Baby Knight (Mounted)',
            4037 => 'Bebê Templário',
            4038 => 'Bebê Monge',
            4039 => 'Bebê Sábio',
            4040 => 'Bebê Arruaceiro',
            4041 => 'Bebê Alquimista',
            4042 => 'Bebê Bardo',
            4043 => 'Bebê Odalisca',
            //4044 => 'Bebê Crusader (Mounted)',
            4045 => 'Super Bebê',

            4046 => 'Taekwon',
            4047 => 'Mestre Taekwon',
            //4048 => 'Star Gladiator (Flying)',
            4049 => 'Espiritualista'];

        return $job;

    }
}
