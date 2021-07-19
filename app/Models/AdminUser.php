<?php

namespace App\Models;

use Dcat\Admin\Models\Administrator;


/**
 * Class Administrator.
 *
 * @property Role[] $roles
 */
class AdminUser extends Administrator
{

    protected $fillable = ['username', 'password', 'name', 'avatar','is_first','email','status'];

}
