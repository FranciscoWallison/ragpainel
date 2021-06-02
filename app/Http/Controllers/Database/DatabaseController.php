<?php

namespace App\Http\Controllers\Database;

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
use Yajra\DataTables\Contracts\DataTable;
use App\Models\Item;
use App\Models\Monster;

class DatabaseController extends Controller
{
    public function item(Request $request)
    {
        $itens = Item::paginate();

        if(Auth::check()) {
            return view('database.item', [
                'user' => $request->user()->userid,
                'photo' => $request->user()->photo,
                'level' => $request->user()->group_id,
                'type_itens' => $this->type(),
                'equipIn' => $this->equip(),
                'itens' => $itens
            ]);
        } else {
            return view('database.item', [
                'user' => null,
                'photo' => null,
                'level' => null,
                'type_itens' => $this->type(),
                'equipIn' => $this->equip(),
                'itens' => $itens
            ]);
        }

    }

    public function itemSearch(Request $request)
    {
        $validator = Validator::make($request->only('itemSearch'), [
            'itemSearch' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('database/item')
                ->withErrors($validator)
                ->withInput();
        }

            $name = Item::where('name_japanese', 'LIKE', '%' .$request->input('itemSearch'). '%')
            ->orWhere('id', 'LIKE', '%' .$request->input('itemSearch') . '%')->paginate();

            if($name){
                $find = $name;
            }

            if (Auth::check()) {
                return view('database.item', [
                    'user' => $request->user()->userid,
                    'photo' => $request->user()->photo,
                    'level' => $request->user()->group_id,
                    'type_itens' => $this->type(),
                    'equipIn' => $this->equip(),
                    'itens' => $find,
                ]);
            } else {
                return view('database.item', [
                    'user' => null,
                    'photo' => null,
                    'level' => null,
                    'type_itens' => $this->type(),
                    'equipIn' => $this->equip(),
                    'itens' => $find
                ]);
            }

    }

    public function type()
    {
        $type_itens = [
            0 => 'Cura',
            2 => 'Usável',
            3 => 'Etc',
            4 => 'Arma',
            5 => 'Armadura',
            6 => 'Carta',
            7 => 'Ovo de PET',
            8 => 'Equipamento de PET',
            10 => 'Munição',
            11 => 'Usável com Delay',
            18 => 'Recompensa de CashShop'];

        return $type_itens;
    }

    public function equip()
    {

        $equipIn = [
            0 => 'Nenhum',
            65536 => 'Armadura Sombria',
            131072 => 'Arma Sombria',
            262144 => 'Escudo Sombrio',
            524288 => 'Sapatos Sombrio',
            1048576 => 'Acessório 2 Sombrio',
            2097152 => 'Acessório 1 Sombrio',
            4096 => 'Visual Baixo',
            2048 => 'Visual Meio',
            1024 => 'Visual Topo',
            256 => 'Cabeça Topo',
            512 => 'Cabeça Meio',
            1 => 'Cabeça Baixo',
            769 => 'Topo/Meio/Baixo Cabeça',
            768 => 'Topo/Meio Cabeça',
            257 => 'Topo/Baixo Cabeça',
            513 => 'Meio/Baixo Cabeça',
            16 => 'Armadura',
            2 => 'Arma',
            32 => 'Escudo',
            34 => 'Duas Mãos',
            50 => 'Armadura/Mãos',
            4 => 'Vestimenta',
            64 => 'Calçado',
            136 => 'Acessório',
            32768 => 'Munição'];

        return $equipIn;

    }

    public function monster(Request $request)
    {
        $monsters = Monster::paginate();

        if(Auth::check()) {
            return view('database.monster', [
                'user' => $request->user()->userid,
                'photo' => $request->user()->photo,
                'level' => $request->user()->group_id,
                'monster_size' => $this->size(),
                'monster_element' => $this->element(),
                'monster_race' => $this->race(),
                'monsters' => $monsters,
            ]);
        } else {
            return view('database.monster', [
                'user' => null,
                'photo' => null,
                'level' => null,
                'type_itens' => $this->type(),
                'monster_size' => $this->size(),
                'monster_element' => $this->element(),
                'monster_race' => $this->race(),
                'monsters' => $monsters,
            ]);
        }

    }

    public function size(){

        $monster_size = [
            0 => 'Médio',
            1 => 'Pequeno',
            2 => 'Grande'
        ];

        return $monster_size;
    }

    public function element(){

        $monster_element = [
            0 => 'Neutro',
            1 => 'Água',
            2 => 'Terra',
            3 => 'Fogo',
            4 => 'Vento',
            5 => 'Veneno',
            6 => 'Sagrado',
            7 => 'Sombrio',
            8 => 'Fantasma',
            9 => 'Maldito'
        ];

        return $monster_element;
    }

    public function race(){
        $monster_race = [
            0 => 'Amorfo',
            1 => 'Morto-Vivo',
            2 => 'Bruto',
            3 => 'Planta',
            4 => 'Inseto',
            5 => 'Peixe',
            6 => 'Demônio',
            7 => 'Humanóide',
            8 => 'Anjo',
            9 => 'Dragão',
        ];

        return $monster_race;
    }

    public function monsterSearch(Request $request)
    {
        $validator = Validator::make($request->only('monsterSearch'), [
            'monsterSearch' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('database/monster')
                ->withErrors($validator)
                ->withInput();
        }

        $name = Monster::where('iName', 'LIKE', '%' .$request->input('monsterSearch'). '%')
            ->orWhere('id', 'LIKE', '%' .$request->input('monsterSearch') . '%')->paginate();

        if($name){
            $find = $name;
        }

        if (Auth::check()) {
            return view('database.monster', [
                'user' => $request->user()->userid,
                'photo' => $request->user()->photo,
                'level' => $request->user()->group_id,
                'monster_size' => $this->size(),
                'monster_element' => $this->element(),
                'monster_race' => $this->race(),
                'monsters' => $find,
            ]);
        } else {
            return view('database.monster', [
                'user' => null,
                'photo' => null,
                'level' => null,
                'monster_size' => $this->size(),
                'monster_element' => $this->element(),
                'monster_race' => $this->race(),
                'monsters' => $find
            ]);
        }

    }
}
