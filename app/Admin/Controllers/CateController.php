<?php

namespace App\Admin\Controllers;

use App\Models\Cate;
use App\Models\CateTheme;
use App\Models\CateType;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;
use Dcat\Admin\Widgets\Card;
use Dcat\Admin\Admin;

class CateController extends AdminController
{

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Cate(), function (Grid $grid) {
            $grid->column('name');
            $grid->column('developer')->using(Cate::$developerConfig);
            $grid->column('sign_id')->using(Cate::$signConfig);
            $grid->column('cooperation_mode')->using(Cate::$cooperationModeConfig);
            $grid->column('cate_theme_id')->display(function($id){
                return CateTheme::find($id)->toArray()['name'];
            });
            $grid->column('cate_type_id')->display(function($id){
                return CateType::find($id)->toArray()['name'];
            });

            $grid->column('其它信息')
            ->display('查看') // 设置按钮名称
            ->modal(function ($modal) {
                // 设置弹窗标题
                $modal->title('其它信息');

                // 自定义图标
                $modal->icon('');
                $html = '<div><lable>游戏密钥：</lable>'.$this->game_secret.'</div><div><lable>游戏签名：</lable>'.$this->app_sign.'</div>';

                $card = new Card(null, $html);

                return "<div style='padding:10px 10px 0'>$card</div>";
            });
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
        return Show::make($id, new Cate(), function (Show $show) {
            $show->field('id');
            $show->field('name');
            $show->field('developer');
            $show->field('sign_id');
            $show->field('cooperation_mode');
            $show->field('cate_theme');
            $show->field('cate_type');
            $show->field('game_secret');
            $show->field('app_sign');
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
        Admin::script($this->script());

        return Form::make(new Cate(), function (Form $form) {
            $form->text('name')->required();
            $form->select('developer')->options(Cate::$developerConfig)->required();
            $form->select('sign_id')->options(Cate::$signConfig)->required();
            $form->select('cooperation_mode')->options(Cate::$cooperationModeConfig)->required();
            $form->select('cate_theme_id')->options(CateTheme::all()->pluck('name', 'id'))->required();
            $form->select('cate_type_id')->options(CateType::all()->pluck('name', 'id'))->required();

             $form->text('game_secret')->append('&nbsp;&nbsp;<span class="input-group-btn"><button type="button" class="btn btn-primary shadow-0 add-secret">生成密钥</button></span>&nbsp;&nbsp;')->required()->disable();

            $form->text('app_sign')->required();
            $form->text('mark');
            $form->hidden('status')->default(1);

            $form->tools(function (Form\Tools $tools) {
                // $tools->disableList();
                // 添加一个按钮, 参数可以是字符串, 匿名函数, 或者实现了Renderable或Htmlable接口的对象实例
                $tools->append(function(){
                    Form::dialog('添加题材/类型')
                        ->click('.create-form') // 绑定点击按钮
                        ->url('game_resources/create') // 表单页面链接，此参数会被按钮中的 “data-url” 属性替换。。
                        ->width('650px') // 指定弹窗宽度，可填写百分比，默认 720px
                        ->height('450px') // 指定弹窗高度，可填写百分比，默认 690px
                        ->success('Dcat.reload()'); // 新增成功后刷新页面

                    return "<span class='btn btn-success create-form'> 新增游戏题材/类型 </span> &nbsp;&nbsp;";
                });
            });
        });
    }

    protected function script(){
        return <<<JS

            $('.add-secret').click(function(){
                var secrte = randomString();
                $( "input[name='game_secret']").attr("value",secrte);
            })

            function randomString() {
              let len = 32;
              let chars ='ABCDEFGHJKMNPQRSTWXYZabcdefhijkmnprstwxyz2345678';
              let maxPos = chars.length;
              let pwd = '';
              for (let i = 0; i < len; i++) {
                pwd += chars.charAt(Math.floor(Math.random() * maxPos));
              }
              return pwd;
            }
JS;
    }
}
