<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PluginParam extends Model
{

    public static $eMarkConfig = [
        1=>'apple',
        2=>'google',
        3=> 'adjust',
        4=> 'facebook',
    ];

    public static $typeConfig = [
        1 =>'ios',
        2 =>'android',
    ];

    public static $useConfig = [
        1 =>'登录',
        2 =>'支付',
        3 =>'归因',
    ];

    public static $paramsConfig = [
        'params_plugin' => '插件参数名',
        'params_back' => '后端参数名',
        'params_web' => '前端参数名',
    ];

    protected $fillable = [
        'name', 'e_mark', 'type','plugin_use','params','status','mark'
    ];

    public function getParamsAttribute($value)
    {
        return array_values(json_decode($value, true) ?: []);
    }

    public function setParamsAttribute($value)
    {
        $this->attributes['params'] = json_encode(array_values($value));
    }

    public function getPluginUseAttribute($value)
    {
        return array_values(array_column(json_decode($value, true) ?: [], 'useType'));
    }

    public function setPluginUseAttribute($PluginUseList){
        $valueNew = [];
        if($PluginUseList = json_decode($PluginUseList)){
            foreach ($PluginUseList as $key => $value) {
                $valueNew[] = ['useType' => $value];
            }
        }
        $this->attributes['plugin_use'] = json_encode($valueNew);
    }



}
