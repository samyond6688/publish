<?php
namespace App\Admin\Controllers;

use Dcat\Admin\Http\Controllers\AdminController;
use Dcat\Admin\Form;
use Dcat\Admin\Layout\Content;
use App\Models\CateTheme;
use Illuminate\Support\Facades\DB;

class GameResourceController extends AdminController
{
    public function create(Content $content)
    {
        return $content
            ->header('添加题材/类型')
            ->description('添加题材/类型')
            ->body($this->form());
    }

    protected function form()
    {
        $form = new Form();
        $form->text('name_theme', "游戏题材")->placeholder('多个请用英文逗号间隔');
        $form->text('name_type', "游戏类型")->placeholder('多个请用英文逗号间隔');

        $form->saving(function (Form $form) {
            if(!empty($form->input('name_theme'))){
                $nameList = explode(',',$form->input('name_theme'));
                foreach ($nameList as $name) {
                   DB::table('cate_themes')->insert(['name' => $name]);
                }

            }

            if(!empty($form->input('name_type'))){
                $nameList = explode(',',$form->input('name_type'));
                foreach ($nameList as $name) {
                   DB::table('cate_types')->insert(['name' => $name]);
                }
            }

            return $form->response()->success('保存成功');
        });

        return $form;

    }

}
