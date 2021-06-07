<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RankingPVP extends Model
{

    protected $table = 'ranking_pvp';

    protected $primaryKey = 'char_id';

    public $timestamps = false;

}
