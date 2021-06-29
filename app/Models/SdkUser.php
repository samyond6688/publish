<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SdkUser extends Model
{
    protected $connection = 'mysql_sdk';

    protected $table = 'users';
}
