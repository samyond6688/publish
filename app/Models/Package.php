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
    public static function pluginParamName($ids=null){
        
        !is_array($ids) && $ids = json_decode($ids,true);
        if(!$ids){
            $plugin_name = PluginParam::all()->pluck('name','id');
        }else{
            $plugin_name = PluginParam::whereIn('id',$ids)->pluck('name','id')->toArray();
        }

        $nameList = [];
        foreach ($plugin_name as $id => $code) {
            $nameList[$id] = Plugin::$nameConfig[$code]??'';
        }
        return $nameList;
    }

}
