<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Medium extends Model
{
    protected $fillable = [
        'name','adjust_channel','status','mark'
    ];


    public function mediumAccounts(){
        return $this->hasMany(MediumAccount::class);
    }
}
