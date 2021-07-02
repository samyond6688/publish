<?php

namespace App\Admin\Controllers;

use App\Models\Game;
use App\Models\Cate;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;
use Dcat\Admin\Widgets\Card;
use Illuminate\Support\Facades\Redis;

class GameController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Game(), function (Grid $grid) {
            $grid->model()->with(['cate']);
            $grid->column('name');
            $grid->column('publisher_id')->using(Game::$publisherConfig);
            $grid->column('sign_id')->using(Game::$signConfig);
            $grid->column('cooperation_mode')->using(Game::$cooperationModeConfig);
            $grid->column('cate.name');
             $grid->column('其它信息')
            ->display('查看') // 设置按钮名称
            ->modal(function ($modal) {
                // 设置弹窗标题
                $modal->title('其它信息');

                // 自定义图标
                $modal->icon('');
                $html = '<div><lable>游戏密钥：</lable>'.$this->game_secret.'</div>';

                $card = new Card(null, $html);

                return "<div style='padding:10px 10px 0'>$card</div>";
            });
            $grid->column('status')->switch();
            $grid->column('mark');

            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('cate_id')->select(Cate::all()->pluck('name', 'id'))->width(3);;
                $filter->equal('id')->select(Game::all()->pluck('name', 'id'))->width(3);;

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
        return Show::make($id, new Game(), function (Show $show) {
            $show->field('id');
            $show->field('name');
            $show->field('cate_id');
            $show->field('publisher_id');
            $show->field('sign_id');
            $show->field('cooperation_mode');
            $show->field('game_secret');
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
        return Form::make(new Game(), function (Form $form) {
            $form->text('name')->required();
            $form->select('cate_id')->options(Cate::all()->pluck('name', 'id'))->required();
            $form->select('publisher_id')->options(Game::$publisherConfig)->required();
            $form->select('sign_id')->options(Game::$signConfig)->required();
            $form->select('cooperation_mode')->options(Game::$cooperationModeConfig)->required();
            $form->text('game_secret')->required();
            $form->hidden('status')->default(1);
            $form->text('mark');

            $form->saved(function (Form $form) {//有更改清缓存
                $rd_key = "table_games";
                Redis::del($rd_key);
            });
        });
    }
}
