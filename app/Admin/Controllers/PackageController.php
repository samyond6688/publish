<?php

namespace App\Admin\Controllers;

use App\Models\Package;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;
use App\Models\PluginParam;
use App\Models\Game;
use Dcat\Admin\Admin;

class PackageController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Package(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('game_id');
            $grid->column('name');
            $grid->column('package_name_id');
            $grid->column('plugin_login');
            $grid->column('plugin_pay');
            $grid->column('plugin_type');
            $grid->column('adjust_key');
            $grid->column('petitioner');
            $grid->column('plugin_params');
            $grid->column('status');
            $grid->column('mark');

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
        return Show::make($id, new Package(), function (Show $show) {
            $show->field('id');
            $show->field('game_id');
            $show->field('name');
            $show->field('package_name_id');
            $show->field('plugin_login');
            $show->field('plugin_pay');
            $show->field('plugin_type');
            $show->field('adjust_key');
            $show->field('petitioner');
            $show->field('plugin_params');
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
        $PluginParam = PluginParam::all()->toArray();

        Admin::script($this->script(json_encode($PluginParam)));

        return Form::make(new Package(), function (Form $form) {
            $form->select('game_id')->options(Game::all()->pluck('name', 'id'))->required();
            $form->text('name')->required();
            $form->text('package_name_id')->required();
            $form->text('mark');
            $form->text('adjust_key')->required();

            $form->select('plugin_type')->options(PluginParam::$typeConfig)->required();

            $form->multipleSelect('plugin_login')->options()->required();

            $form->multipleSelect('plugin_pay')->options(PluginParam::whereRaw('JSON_CONTAINS(plugin_use,JSON_OBJECT("useType", "2"))')->pluck('name','id'))->saving(function ($value) {
                // 转化成json字符串保存到数据库
                return json_encode($value);
            })->required();

            $form->html(function (Form $form) {

                return "<div class='gg-class'><h6>谷歌参数</h6>".$form->text('mark').$form->text('mark').$form->text('mark')."</div>";
            });

            $form->hidden('status')->default(1);
            $form->hidden('plugin_params')->default(null);


        });
    }

    protected function script($pluginParam){
        return <<<JS
            var pluginParam = $pluginParam;

            $('select[name="plugin_type"]').change(function(){
                var pluginLoginHtml = '';
                var pluginPayHtml = '';

                let plugin_type = $(this).val();
                if(pluginParam.length > 0){
                    for(let i = 0; i < pluginParam.length; i++) {
                        let plugin = pluginParam[i];
                        if(plugin.type == plugin_type){
                            let plugin_use = plugin.plugin_use;
                            if(plugin_use.includes('1')){//包含登录用途的插件
                                pluginLoginHtml += '<option value="'+plugin.id+'">'+plugin.name+'</option>'
                            }

                            if(plugin_use.includes('2')){//包含支付用途的插件
                                pluginPayHtml += '<option value="'+plugin.id+'">'+plugin.name+'</option>'
                            }
                        }
                    }
                }

               $('select[name="plugin_login[]"]').html(pluginLoginHtml)
               $('select[name="plugin_pay[]"]').html(pluginPayHtml)

            })


            //判断选择内容
            $('select[name="plugin_login[]"],select[name="plugin_pay[]"]').change(function(){
                let plugin = []
                let pluginLogin = $('select[name="plugin_login[]"]').val()
                let pluginPay = $('select[name="plugin_pay[]"]').val()

                if(pluginLogin.length > 0){
                    for(let i = 0; i < pluginLogin.length; i++) {
                        if(!plugin.includes(pluginLogin[i])){
                            plugin.push(pluginLogin[i])
                        }
                    }
                }

                if(pluginPay.length > 0){
                    for(let i = 0; i < pluginPay.length; i++) {
                        if(!plugin.includes(pluginPay[i])){
                            plugin.push(pluginPay[i])
                        }
                    }
                }

                for(let i = 0; i < plugin.length; i++) {
                      for(let j = 0; j < pluginParam.length; j++) {
                        if(plugin[i] == pluginParam[j].id){
                            let pluginName = pluginParam[j].name
                            let pluginId = pluginParam[j].id
                            let params = pluginParam[j].params
                            for(let k =0;k < params.length; k++){
                                let = params[k].params_plugin

                            }
                        }
                      }
                }

            })

JS;
    }
}
