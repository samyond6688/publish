<?php

namespace App\Admin\Controllers;

use App\Models\MediumAccount;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;
use Dcat\Admin\Models\Administrator;
use App\Models\Medium;
use Dcat\Admin\Widgets\Card;

class MediumAccountController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new MediumAccount(), function (Grid $grid) {
            $grid->model()->with(['media']);
            $grid->column('media.name');
            $grid->column('type')->using(MediumAccount::$typeConfig);
            $grid->column('account');
            $grid->column('password')->display('查看') // 设置按钮名称
            ->modal(function ($modal) {
                // 设置弹窗标题
                $modal->title('账号密码');

                // 自定义图标
                $modal->icon('');

                $card = new Card(null, $this->password);

                return "<div style='padding:10px 10px 0'>$card</div>";
            });

            $grid->column('account_id');
            $grid->column('account_name');
            $grid->column('agent_id')->using(MediumAccount::$agentConfig);
            $grid->column('company_id')->using(MediumAccount::$companyConfig);
            $grid->column('owner_id')->display(function($value){
                return Administrator::find($value)->name;
            });
            $grid->column('status')->switch();
            $grid->column('mark');
            $grid->column('created_at');

            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('account_name')->width(3);
                $filter->equal('type')->select(MediumAccount::$typeConfig)->width(3);
                $filter->equal('owner_id')->select(Administrator::all()->pluck('name', 'id'))->width(3);
                $filter->equal('company_id')->select(MediumAccount::$companyConfig)->width(3);
                $filter->equal('media_id')->select(Medium::all()->pluck('name', 'id'))->width(3);
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
        return Show::make($id, new MediumAccount(), function (Show $show) {
            $show->field('id');
            $show->field('media_id');
            $show->field('type');
            $show->field('account');
            $show->field('password');
            $show->field('account_id');
            $show->field('account_name');
            $show->field('agent_id');
            $show->field('company_id');
            $show->field('owner');
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
        return Form::make(new MediumAccount(), function (Form $form) {
            $form->select('media_id')->options(Medium::all()->pluck('name', 'id'))->required();
            $form->select('type')->options(MediumAccount::$typeConfig)->required();
            $form->text('account')->required();
            $form->text('password')->required();
            $form->text('account_id');
            $form->text('account_name');
            $form->select('agent_id')->options(MediumAccount::$agentConfig)->required();
            $form->select('company_id')->options(MediumAccount::$companyConfig)->required();
            $form->select('owner_id')->options(Administrator::all()->pluck('name', 'id'))->required();
            $form->hidden('status')->default(1);
            $form->text('mark');

        });
    }
}
