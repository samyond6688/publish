<?php

namespace App\Admin\Controllers;

use App\Models\Supplement;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Layout\Content;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class SupplementController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Supplement(), function (Grid $grid) {
            $grid->model()->where('pay_status',3);
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
            $grid->column('pay_amout_str');
            $grid->column('pay_amout');
            $grid->column('product_amout');
            $grid->column('game_product_id');
            $grid->column('product_id');
            $grid->column('currency_type');
            $grid->column('pay_status');
            $grid->column('pay_type');
            $grid->column('pay_no');
            $grid->column('ip');
            $grid->column('ext');
            $grid->column('gg_ext');
            $grid->column('pay_finish_time');
            $grid->column('callcakc_success_time');
            $grid->column('created_date');
            $grid->column('created_at');
        
            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');
        
            });
        });
    }

    public function index(Content $content)
    {
        $OrderController = new OrderController();
        return $content
            ->translation($this->translation())
            ->title($this->title())
            ->description($this->description()['index'] ?? trans('admin.list'))
            ->body($OrderController->grid([3]));
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     *
     * @return Show
     */
    protected function detail($id)
    {
        return Show::make($id, new Supplement(), function (Show $show) {
            $show->field('id');
            $show->field('open_id');
            $show->field('cate_id');
            $show->field('game_id');
            $show->field('package_id');
            $show->field('udid');
            $show->field('adid');
            $show->field('role_id');
            $show->field('role_name');
            $show->field('role_level');
            $show->field('order_id');
            $show->field('game_order_id');
            $show->field('pay_amout_str');
            $show->field('pay_amout');
            $show->field('product_amout');
            $show->field('game_product_id');
            $show->field('product_id');
            $show->field('currency_type');
            $show->field('pay_status');
            $show->field('pay_type');
            $show->field('pay_no');
            $show->field('ip');
            $show->field('ext');
            $show->field('gg_ext');
            $show->field('pay_finish_time');
            $show->field('callcakc_success_time');
            $show->field('created_date');
            $show->field('created_at');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new Supplement(), function (Form $form) {
            $form->display('id');
            $form->text('open_id');
            $form->text('cate_id');
            $form->text('game_id');
            $form->text('package_id');
            $form->text('udid');
            $form->text('adid');
            $form->text('role_id');
            $form->text('role_name');
            $form->text('role_level');
            $form->text('order_id');
            $form->text('game_order_id');
            $form->text('pay_amout_str');
            $form->text('pay_amout');
            $form->text('product_amout');
            $form->text('game_product_id');
            $form->text('product_id');
            $form->text('currency_type');
            $form->text('pay_status');
            $form->text('pay_type');
            $form->text('pay_no');
            $form->text('ip');
            $form->text('ext');
            $form->text('gg_ext');
            $form->text('pay_finish_time');
            $form->text('callcakc_success_time');
            $form->text('created_date');
            $form->text('created_at');
        });
    }
}
