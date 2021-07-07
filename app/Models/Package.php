<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    //

    public function game(){
        return $this->belongsTo(Game::class);
    }

    /**
     * 包插件参数id集对应的插件名称集
     * @param $ids
     * @return array|string
     */
    public static function pluginParamName(){
        $plugin_name = PluginParam::all()->pluck('name','id');
        $nameList = [];
        foreach ($plugin_name as $id => $code) {
            $nameList[$id] = Plugin::$nameConfig[$code]??'';
        }
        return $nameList;
    }


}
