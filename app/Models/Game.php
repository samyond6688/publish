<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $fillable = [
        'name', 'game_group_id', '','publisher_id','cooperation_mode','game_secret','app_sign','status','mark'
    ];

    public static $signConfig = [
        1 =>'上海游民1',
        2 =>'上海游民2',
        3 =>'上海游民3',
    ];

    public static $cooperationModeConfig = [
        1 =>'独代',
        2 =>'定制',
        3 =>'联运',
        4 =>'自研',
    ];

    public static $publisherConfig = [
        1 =>'发行商1',
        2 =>'发行商2',
        3 =>'发行商3',
    ];

    public function gameGroup(){
        return $this->belongsTo(GameGroup::class);
    }
}
