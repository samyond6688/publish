<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServingPlan extends Model
{
    protected $fillable = [
        'ad_name', 'adj_fb_account_id', 'adj_tracker','adj_app_name','adj_network_name','adj_campaign_id','adj_ad_id','adj_creative_id','is_organic','package_name','package_plugin_type','status','mark'
    ];


    public function package(){
        return Package::where('package_name_id',$this->adj_app_name)->first();
    }

    public function mediumAccount(){
        return MediumAccount::where('tracker',$this->adj_tracker)->orWhere('account_id', $this->adj_fb_account_id)->first();
    }
}
