<?php

namespace App\Admin\Controllers;

use App\Models\SdkUser;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class SdkUserController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new SdkUser(), function (Grid $grid) {
            $grid->column('open_id');
            // $grid->column('cate_id');
            // $grid->column('game_id');
            // $grid->column('package_id');
            $grid->column('udid');
            $grid->column('adid');
            $grid->column('gc_openid');
            $grid->column('gg_openid');
            $grid->column('oauth_code');
            $grid->column('login_type');
            $grid->column('ip');
            $grid->column('last_login_ip');
            $grid->column('last_login_time');
            $grid->column('created_at');

            // $grid->filter(function (Grid\Filter $filter) {
            //     $filter->equal('id');

            // });
        });
    }
}
