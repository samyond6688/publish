<?php

namespace App\Admin\Controllers;

use App\Models\ServingPlan;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;
use App\Models\Package;
use App\Models\MediumAccount;
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

            $grid->column('投放媒体')->display(function($value){
                 return empty($this->mediumAccount()) ? "自然量" : $this->mediumAccount()->medium->name;
            });

            $grid->column('媒体账号')->display(function($value){
                 return empty($this->mediumAccount()) ? "自然量" : $this->mediumAccount()->account;
            });

            $grid->column('账号id')->display(function($value){
                 return empty($this->mediumAccount()) ? "自然量" : $this->mediumAccount()->account_id;
            });

            $grid->column('游戏')->display(function($value){
                 return $this->package()->name;
            });

            $grid->column('adj_app_name');

            $grid->column('系统')->display(function($value){
                 return PluginParam::$typeConfig[$this->package()->plugin_type];
            });

            $grid->column('归属人')->display(function($value){
                return empty($this->mediumAccount()) ? "自然量" : Administrator::find($this->mediumAccount()->owner_id)->name;
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
