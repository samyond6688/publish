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
            $grid->column('name')->using(Plugin::$nameConfig);
            $grid->column('sign')->using(PluginParam::$signConfig);
            $grid->column('type')->using(PluginParam::$typeConfig);
            $grid->column('plugin_use')->display(function($value){
                $value = json_decode($value);
                $newValue = [];
                foreach ($value as $key) {
                    $newValue[] = PluginParam::$useConfig[$key];
                }
                return $newValue;
            })->label();

            $grid->column('params')->display('查看')->modal(function ($modal) {
                // 设置弹窗标题
                $modal->title('插件参数');

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
            $grid->column('remark');

            $grid->filter(function (Grid\Filter $filter) {
                $filter->panel();
                $filter->equal('name')->select(Plugin::$nameConfig)->width(3);
                $filter->equal('sign')->select(PluginParam::$signConfig)->width(3);
                $filter->equal('type')->select(PluginParam::$typeConfig)->width(3);
                $filter->equal('plugin_use')->select(PluginParam::$useConfig)->width(3);
            });

            $grid->disableBatchActions();
            $grid->disableBatchDelete();//禁用批量操作
            $grid->disableRowSelector();
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
            $show->field('sign');
            $show->field('type');
            $show->field('plugin_use');
            $show->field('params');
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
        return Form::make(new PluginParam(), function (Form $form) {
            $form->display('id');
            $form->select('name')->options(Plugin::$nameConfig);
            $form->select('sign')->options(PluginParam::$signConfig);
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

            $form->text('remark')->width(4);

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
