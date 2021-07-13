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
        $model = new ServingPlan();
        return Grid::make(new ServingPlan(), function (Grid $grid) use ($model){

            $config = $model->configAll();

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
                 return PluginParam::$typeConfig[$value] ?? '';
            });

            $grid->column('medium_account_owner_id')->display(function($value){
                return empty($value) ? "自然量" : Administrator::find($value)->name;
            });

            $grid->column('created_at');

            $grid->column('mark',admin_trans('admin.action'))->display(admin_trans_field('mark'))->modal(function ($modal) {
                $modal->title(admin_trans_field('mark'));
                $modal->icon('');
                $html = '<div>';
                $html .= "<h4>" . $this->id. "</h4>";
                $html .= "<div><span>" . $this->mark . "</span></div>";
                $html .= "</div>";
                return $html;
            });

            $grid->disableActions();//禁用操作
            $grid->disableCreateButton();//禁用新增按钮

            $grid->showColumnSelector();
            // 设置默认隐藏字段
            $grid->hideColumns(['']);

            $grid->disableFilterButton();
            $grid->filter(function (Grid\Filter $filter) use ($config) {
                $filter->expand();
                $filter->equal('id')->width(3);
                $filter->equal('id')->width(3);

                $filter->where('search_account', function ($query) use ($config){
                    foreach ($this->input as $input){
                        $query->orwhere('medium_account_account', 'like', "%{$config['medium_account_account'][$input]}%");
                    }
                }, admin_trans_field('medium_account_account'))->multipleSelect($config['medium_account_account'])->width(3);


                $filter->where('search_medium_name', function ($query) use ($config) {
                    foreach ($this->input as $input){
                        $query->orwhere('medium_name', 'like', "%{$config['medium_name'][$input]}%");
                    }
                }, admin_trans_field('medium_name'))->multipleSelect($config['medium_name'])->width(3);


                $filter->where('search_account_owner_id', function ($query) use ($config){
                    foreach ($this->input as $input){
                        $query->orwhere('medium_account_owner_id', 'like', "%{$config['medium_account_owner_id'][$input]}%");
                    }
                }, admin_trans_field('medium_account_owner_id'))->multipleSelect($config['medium_account_owner_id'])->width(3);


                $filter->where('ad_name', function ($query) use ($config){
                    $query->orwhere('ad_name', 'like', "%{$this->input}%");
                }, admin_trans_field('ad_name'))->width(3);

            });
        });
    }
}
