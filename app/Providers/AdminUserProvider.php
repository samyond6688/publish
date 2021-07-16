<?php

namespace App\Providers;


use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Hashing\BcryptHasher;
use Illuminate\Support\Str;

class AdminUserProvider extends  EloquentUserProvider
{


    /**
     * The hasher implementation.
     *
     * @var \Illuminate\Contracts\Hashing\Hasher
     */
    protected $hasher;

    /**
     * The Eloquent user model.
     *
     * @var string
     */
    protected $model;

    public function __construct($model)
    {

        $this->model = $model;
    }



    public function retrieveByCredentials(array $credentials)
    {
        if (empty($credentials) ||
            (count($credentials) === 1 &&
                Str::contains($this->firstCredentialKey($credentials), 'password'))) {
            return;
        }

        // First we will add each credential element to the query as a where clause.
        // Then we can execute the query and, if we found a user, return it in a
        // Eloquent User "model" that will be utilized by the Guard instances.
        $query = $this->newModelQuery();

        foreach ($credentials as $key => $value) {
            if (Str::contains($key, 'password')) {
                continue;
            }
            if (Str::contains($key, 'captcha')) {
                continue;
            }
            if (is_array($value) || $value instanceof Arrayable) {
                $query->whereIn($key, $value);
            } else {
                $query->where($key, $value);
            }
        }
        $data =  $query->first();

        //验证验证码$data->code
        return $data;
    }

    public function validateCredentials(Authenticatable $user, array $credentials)
    {
        // 用$credentials里面的用户名密码校验用户，返回true或false
        //dump($user->getAuthPassword());
        $BcryptHasher = new BcryptHasher();
        return $BcryptHasher->check($credentials['password'],$user->getAuthPassword());
        //return true;
    }
}
