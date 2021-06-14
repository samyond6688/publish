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
    $router->resource('game_groups', 'GameGroupController');
    $router->resource('game_resources', 'GameResourceController');
    $router->resource('games', 'GameController');
});
