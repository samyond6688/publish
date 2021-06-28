<?php

namespace App\Admin\Controllers;

use App\Models\ServingPlan;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

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
            $grid->column('id')->sortable();
            $grid->column('ad_name');
            $grid->column('adj_app_name');
            $grid->column('status');
            $grid->column('mark');
            $grid->column('created_at');
            $grid->column('updated_at')->sortable();
        
            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');
        
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
        return Show::make($id, new ServingPlan(), function (Show $show) {
            $show->field('id');
            $show->field('ad_name');
            $show->field('adj_app_name');
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
        return Form::make(new ServingPlan(), function (Form $form) {
            $form->display('id');
            $form->text('ad_name');
            $form->text('adj_app_name');
            $form->text('status');
            $form->text('mark');
        
            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
