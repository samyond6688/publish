<?php

namespace App\Admin\Controllers;

use App\Models\Order;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class OrderController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Order(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('open_id');
            $grid->column('cate_id');
            $grid->column('game_id');
            $grid->column('package_id');
            $grid->column('udid');
            $grid->column('adid');
            $grid->column('role_id');
            $grid->column('role_name');
            $grid->column('role_level');
            $grid->column('order_id');
            $grid->column('game_order_id');
            $grid->column('pay_amout');
            $grid->column('product_amout');
            $grid->column('game_product_id');
            $grid->column('product_id');
            $grid->column('currency_type');
            $grid->column('pay_status');
            $grid->column('pay_type');
            $grid->column('pay_no');
            $grid->column('ip');
            $grid->column('pay_finish_time');
            $grid->column('callcakc_success_time');
            $grid->column('created_date');
            $grid->column('created_at');

            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');

            });
        });
    }

}
