<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MediumAccount extends Model
{
    protected $fillable = [
        'media_id','type','account','password','account_id','account_name','agent_id','company_id','owner_id','status','mark'
    ];

    public static $typeConfig = [
        1 =>'普通账号',
        2 =>'开发者账号',
        3 =>'管家账号',
    ];

    public static $agentConfig = [
        1 =>'代理1',
        2 =>'代理2',
        3 =>'代理3',
    ];

    public static $companyConfig = [
        1 =>'上海游民',
        2 =>'阿里',
        3 =>'腾讯',
    ];

    public function medium(){
        return $this->belongsTo(Medium::class);
    }

}
