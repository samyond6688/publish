<?php

namespace App\Admin\Controllers;

use App\Models\Plugin;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Admin;
use Dcat\Admin\Http\Controllers\AdminController;
use Dcat\Admin\Widgets\Card;

class PluginController extends AdminController
{

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Plugin(), function (Grid $grid) {
            $grid->column('company')->using(Plugin::$companyConfig);

            $grid->column('name')->using(Plugin::$nameConfig);

            $grid->column('account');

            $grid->column('password')
            ->display('查看') // 设置按钮名称
            ->modal(function ($modal) {
                // 设置弹窗标题
                $modal->title('账号密码');

                // 自定义图标
                $modal->icon('');

                $card = new Card(null, $this->password);

                return "<div style='padding:10px 10px 0'>$card</div>";
            });

            $grid->column('site')->link();

            $grid->column('admin');
            $grid->column('type')->using(Plugin::$accountTypeConfig);
            $grid->column('mark');
            $grid->column('status')->switch();
            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('company')->select(Plugin::$companyConfig)->width(3);
                $filter->equal('name')->select(Plugin::$nameConfig)->width(3);
                $filter->equal('admin')->width(3);
                $filter->equal('type')->select(Plugin::$accountTypeConfig)->width(3);
            });

        });
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
        return Show::make($id, new Plugin(), function (Show $show) {
            $show->field('id');
            $show->field('name');
            $show->field('company');
            $show->field('account');
            $show->field('password');
            $show->field('site');
            $show->field('type');
            $show->field('admin');
            $show->field('status');
            $show->field('mark');
            $show->field('created_at');
            $show->field('updated_at');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new Plugin(), function (Form $form) {
            $form->display('id');
            $form->select('name')->options(Plugin::$nameConfig);
            $form->select('company')->options(Plugin::$companyConfig);
            $form->text('account');
            $form->text('password');
            $form->text('site');
            $form->select('type')->options(Plugin::$accountTypeConfig);
            $form->text('admin');
            $form->text('mark');
            $form->hidden('status')->default(1);
        });
    }
}
