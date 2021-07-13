<?php

namespace App\Admin\Controllers;

use App\Models\PluginParam;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;
use App\Models\Plugin;
use Dcat\Admin\Form\NestedForm;
use Dcat\Admin\Widgets\Card;


class PluginParamController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new PluginParam(), function (Grid $grid) {
            $grid->column('id');
            $grid->column('name')->using(Plugin::$nameConfig);
            $grid->column('e_mark')->using(PluginParam::$eMarkConfig);
            $grid->column('type')->using(PluginParam::$typeConfig);
            $grid->column('plugin_use')->display(function($value){
                $newValue = [];
                foreach ($value as $key) {
                    $newValue[] = PluginParam::$useConfig[$key];
                }
                return $newValue;
            })->label();

            $grid->column('params')->display(admin_trans_label('param_key'))->modal(function ($modal) {
                // 设置弹窗标题
                $modal->title(admin_trans_label('plugin-param'));

                // 自定义图标
                $modal->icon('');
                $paramsList = $this->params;
                if(!is_array($paramsList) or empty($paramsList)) return '';

                $text = '<table width="100%"><tr>';
                foreach (array_keys($paramsList[0]) as $key => $value) {
                   $text .= '<th>'.PluginParam::$paramsConfig[$value].'</th>';
                }
                $text .= '</tr>';

                foreach ($paramsList as $params) {
                    $text .= '<tr>';
                    foreach ($params as $value) {
                        $text .= '<td>'.$value.'</td>';
                    }
                    $text .= '</tr>';
                }

                $text .= '</table>';


                $card = new Card(null, $text);

                return "<div style='padding:10px 10px 0'>$card</div>";
            });

            $grid->column('status')->switch();
            $grid->column('mark');

            $grid->disableFilterButton();
            $grid->filter(function (Grid\Filter $filter) {
                $filter->expand();
                $filter->equal('name')->select(Plugin::$nameConfig)->width(3);
                $filter->equal('e_mark')->select(PluginParam::$eMarkConfig)->width(3);
                $filter->equal('type')->select(PluginParam::$typeConfig)->width(3);
                $filter->where('plugin_use',function($query){
                    $query->whereRaw('JSON_CONTAINS(plugin_use,JSON_OBJECT("useType", "'.$this->input.'"))');
                })->select(PluginParam::$useConfig)->width(3);
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
        return Show::make($id, new PluginParam(), function (Show $show) {
            $show->field('id');
            $show->field('name');
            $show->field('e_mark');
            $show->field('type');
            $show->field('plugin_use');
            $show->field('params');
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

        return Form::make(new PluginParam(), function (Form $form) {
            $form->display('id');
            $form->select('name')->options(Plugin::$nameConfig);
            $form->select('e_mark')->options(PluginParam::$eMarkConfig);
            $form->select('type')->options(PluginParam::$typeConfig);
            // $form->select('plugin_use')->options(PluginParam::$useConfig);
            $form->checkbox('plugin_use')
            ->options(PluginParam::$useConfig)
            ->saving(function ($value) {
                // 转化成json字符串保存到数据库
                return json_encode($value);
            });
            // $form->text('params');
            $form->table('params', function (NestedForm $table) {
                foreach (PluginParam::$paramsConfig as $key => $value) {
                    $table->text($key,$value);
                }
            });
            $form->text('mark');
            $form->hidden('status')->default(1);
        });
    }


}
