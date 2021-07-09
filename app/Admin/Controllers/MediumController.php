<?php

namespace App\Admin\Controllers;

use App\Models\Medium;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class MediumController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Medium(), function (Grid $grid) {
            $grid->model()->orderBy('id', 'desc');
            $grid->column('id')->sortable();
            $grid->column('name');
            $grid->column('adjust_channel');
            $grid->column('status')->switch();
            $grid->column('mark');

            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('name')->width(3);
                $filter->equal('status')->select([0=>'关闭',1=>'开启'])->width(3);

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
        return Show::make($id, new Medium(), function (Show $show) {
            $show->field('id');
            $show->field('name');
            $show->field('adjust_channel');
            $show->field('status');
            $show->field('mark');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new Medium(), function (Form $form) {
            $form->text('name')->rules('required|unique:media');;
            $form->text('adjust_channel')->required();
            $form->hidden('status')->default(1);
            $form->text('mark');
        });
    }
}
