<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Supplement extends Model
{
    protected $connection = 'mysql_sdk';
    protected $table = 'orders';
    public $timestamps = false;

}
