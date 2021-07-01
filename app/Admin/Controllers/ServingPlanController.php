<?php

namespace App\Admin\Controllers;

use App\Models\ServingPlan;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;
use App\Models\PluginParam;
use Dcat\Admin\Models\Administrator;

class ServingPlanController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new ServingPlan(), function (Grid $grid) {

            $grid->model()->orderBy('id', 'desc');
            $grid->column('id')->sortable();
            $grid->column('ad_name');

            $grid->column('medium_name')->display(function($value){
                 return empty($value) ? "自然量" : $value;
            });

            $grid->column('medium_account_account')->display(function($value){
                 return empty($value) ? "自然量" : $value;
            });

            $grid->column('medium_account_account_id')->display(function($value){
                 return empty($value) ? "自然量" : $value;
            });

            $grid->column('package_name');

            $grid->column('adj_app_name');

            $grid->column('package_plugin_type')->display(function($value){
                 return PluginParam::$typeConfig[$value];
            });

            $grid->column('medium_account_owner_id')->display(function($value){
                return empty($value) ? "自然量" : Administrator::find($value)->name;
            });

            $grid->column('created_at');

            $grid->column('mark');

            $grid->disableActions();//禁用操作
            $grid->disableCreateButton();//禁用新增按钮

            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id')->width(3);

            });
        });
    }
}
