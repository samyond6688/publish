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
            $grid->column('comain')->using(Plugin::$comainConfig);

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

            $grid->column('login_url')->link();

            $grid->column('admin_name');
            $grid->column('account_type')->using(Plugin::$accountTypeConfig);
            $grid->column('remark');
            $grid->column('status')->switch();
            $grid->filter(function (Grid\Filter $filter) {
                $filter->panel();
                $filter->equal('comain')->select(Plugin::$comainConfig)->width(3);
                $filter->equal('name')->select(Plugin::$nameConfig)->width(3);
                $filter->equal('admin_name')->width(3);
                $filter->equal('account_type')->select(Plugin::$accountTypeConfig)->width(3);
            });

            $grid->disableBatchActions();
            $grid->disableBatchDelete();//禁用批量操作
            $grid->disableRowSelector();
            // $grid->showColumnSelector();
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
            $show->field('comain');
            $show->field('account');
            $show->field('password');
            $show->field('login_url');
            $show->field('account_type');
            $show->field('admin_name');
            $show->field('status');
            $show->field('remark');
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
            $form->select('comain')->options(Plugin::$comainConfig);
            $form->text('account');
            $form->text('password');
            $form->text('login_url');
            $form->select('account_type')->options(Plugin::$accountTypeConfig);
            $form->text('admin_name');
            $form->text('remark');

            $form->hidden('status');

            $form->footer(function ($footer) {

                // 去掉`查看`checkbox
                $footer->disableViewCheck();

                // 去掉`继续编辑`checkbox
                $footer->disableEditingCheck();

                // 去掉`继续创建`checkbox
                $footer->disableCreatingCheck();

            });
        });
    }
}
