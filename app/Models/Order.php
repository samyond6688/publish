<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $connection = 'mysql_sdk';

    public $timestamps = false;

}
