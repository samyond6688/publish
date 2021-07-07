<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class CostProduct extends Model
{
	
    protected $table = 'cost_product';

    protected $fillable = ['status','product_id','amount'];
}
