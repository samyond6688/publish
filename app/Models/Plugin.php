<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plugin extends Model
{

    public static $nameConfig = [
        'google' => '谷歌[google]',
        'apple' => '苹果[apple]',
        'facebook' => 'Facebook',
        'adjust' => 'adjust后台',
        'shushu' => '数数后台',
    ];

    public static $companyConfig = [
        'shanghaiyouming'=>'上海游民',
        'ali'=>'阿里',
        'tencent'=>'腾讯',
    ];

    public static $accountTypeConfig = [
        1 => '开发者后台',
        2 => '商户后台',
        3 => '结算后台',
        4 => '数据后台',
    ];

    protected $fillable = [
        'name', 'company', 'account','password','site','type','admin','status','mark'
    ];





}
