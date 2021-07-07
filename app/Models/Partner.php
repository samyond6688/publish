<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
	
    protected $table = 'partner';

    public static $partnerType = [
        1 =>'游戏开发商',
        2 =>'联运渠道商',
        3 =>'投放媒体商',
        4 =>'广告代理商',
        5 =>'3k旗下公司',
        6 =>'第三方服务供应商',
    ];

    //开票项目
    public static $partnerItems = [
        1 => '信息费',
        2 => '信息服务费',
        3 => '信息技术服务费',
        5 => '信息系统服务费',
        6 => '计算机网络技术研究服务费',
        7 => '计算机网络技术开发服务费',
        8 => '计算机软硬件开发费',
        9 => '广告费',
        10 => '广告服务费',
    ];

    protected $fillable = [
        'name', 'partner_type','status',
        'tax_id_label','tax_address','tax_bank','tax_bank_account','tax_mobile','tax_item_type',
        'collection_bank','collection_bank_account','collection_desc',
        'addressee_name','addressee_address','addressee_desc','addressee_mobile',
    ];

    public function getPartnerTypeAttribute($value)
    {
        return array_values(explode(',',$value) ?: []);
    }
}
