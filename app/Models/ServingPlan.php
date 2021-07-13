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

    public function configAll(){
        $fields = ['ad_name','medium_account_owner_id','medium_account_account_id','medium_account_account','medium_account_account_id','adj_app_name','medium_name'];
        $return = [];
        foreach ($fields as $field){
            $return[$field] = array_merge($this->select($field)->groupby($field)->pluck($field)->toArray(),['自然量']);
        }
        return $return;
    }
}
