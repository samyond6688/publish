<?php

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
    $router->resource('partner', 'PartnerController');
    $router->resource('cost_product', 'CostProductController');
    $router->post('api/pluginParam', 'PackageController@pluginParam')->name('api.pluginParam');;
    //$router->resource('sdk', 'OrderController');
});
