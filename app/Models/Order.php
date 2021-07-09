<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $connection = 'mysql_sdk';
    public $timestamps = false;
    public static $pushStatus = [
        0 =>'未推送',
        1 =>'推送成功',
        2 =>'推送失败',
        3 =>'推送账号id验证失败',
        4 =>'https请求超时',
    ];
    public static $payType = [
        1 =>'正式订单',
        2 =>'沙箱订单',
    ];

    public static $payPlugin = [
        1 =>'谷歌支付',
        2 =>'苹果支付',
    ];

    public static $orderType = [
        1 =>'正式订单',
        2 =>'沙箱订单',
    ];

    public static $orderStatus = [
        0 =>'等待支付',
        1 =>'支付成功',
        2 =>'支付失败',
        3 =>'已退款',
        4 =>'支付账号id验证错误',
        5 =>'未支付已回调',
        6 =>'下单金额与实际金额不一致',
        7 =>'苹果返回错误',
        8 =>'苹果流水号验证失败',
        9 =>'苹果流水号重复',
    ];

    public function getAmount($product_id,$order){
        return rand(6,9);
    }

    //关联模型(登录插件和充值插件
    public function package(){
        $Package = new Package();
        return $this->setConnection($Package->getConnectionName())->hasOne(Package::class,'id','package_id');
    }

    //关联模型(登录插件和充值插件
    public function cate(){
        $Cate = new Cate();
        return $this->setConnection($Cate->getConnectionName())->hasOne(Cate::class,'id','cate_id');
    }

    //关联模型(登录插件和充值插件
    public function game(){
        $Game = new Game();
        return $this->setConnection($Game->getConnectionName())->hasOne(Game::class,'id','game_id');
    }



}
