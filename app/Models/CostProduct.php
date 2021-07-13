<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class CostProduct extends Model
{


    protected $fillable = ['status','product_id','amount','cate_id'];

    public function cate(){
        return $this->belongsTo(Cate::class);
    }
}
