<?php

use Gregwar\Captcha\CaptchaBuilder;
use Gregwar\Captcha\PhraseBuilder;
use Illuminate\Support\Facades\Session;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use Dcat\Admin\Admin;

Admin::routes();

Route::group([
    'prefix'     => config('admin.route.prefix'),
    'namespace'  => config('admin.route.namespace'),
    'middleware' => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index');
    $router->resource('plugins', 'PluginController');
    $router->resource('plugin_params', 'PluginParamController');
    $router->resource('cates', 'CateController');
    $router->resource('game_resources', 'GameResourceController');
    $router->resource('games', 'GameController');
    $router->resource('media', 'MediumController');
    $router->resource('medium_accounts', 'MediumAccountController');
    $router->resource('packages', 'PackageController');
    $router->get('packages/{package_id}/load', 'PackageController@load')->name('package.load');
    $router->resource('serving_plans', 'ServingPlanController',['only' => ['index']]);
    $router->get('sdk/users', 'SdkUserController@index');
    $router->resource('sdk/orders', 'OrderController');
    $router->resource('sdk/supplement', 'SupplementController');
    $router->resource('partners', 'PartnerController');
    $router->resource('cost_products', 'CostProductController');
    $router->post('api/pluginParams', 'PackageController@pluginParam')->name('api.pluginParam');;
    //$router->resource('sdk', 'OrderController');

    $router->post('/resetPassword', 'AdminUserController@resetPassword')->name('resetPassword');
    $router->resource('auth/users', 'AdminUserController');
    $router->get('api/thirdLogin', 'ApiController@thirdLogin');
    $router->post('auth/setting', 'AuthController@putSetting');//支持post
    $router->any('/captcha', function() {
        $phraseBuilder = new PhraseBuilder(4);
        $builder = new CaptchaBuilder(null,$phraseBuilder);
        $builder->setTextColor(0,0,0);
        $builder->setBackgroundColor(220, 210, 230);// 设置背景颜色RGB
        $builder->setDistortion(false);
        $builder->build(100, 40);
        $phrase = $builder->getPhrase();
        //把内容存入session
        Session::flash('milkcaptcha', $phrase); //存储验证码
        ob_clean();
        return response($builder->output())->header('Cache-Control', 'no-cache')->header('Content-type', 'image/jpeg');
    });
});
