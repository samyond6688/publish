<?php

namespace App\Admin\Controllers;

use App\Models\SdkUser;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;
use Dcat\Admin\Widgets\Card;
use Dcat\Admin\Widgets\Table;

class SdkUserController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new SdkUser(), function (Grid $grid) {
            $grid->column('open_id');
            // $grid->column('cate_id');
            // $grid->column('game_id');
            // $grid->column('package_id');
            //$grid->column('udid');
            //$grid->column('adid');
            //$grid->column('gc_openid');
            //$grid->column('gg_openid');
            $grid->column('email');
            $grid->column('login_type');
            $grid->column('content', admin_trans_label('user-info'))->display(admin_trans_field("look"))->expand(function (Grid\Displayers\Expand $expand) {

                $html = '<table><t>' . admin_trans_field('game_secret') . '：</t>' . $this->game_secret . '</>
<div><lable>' . admin_trans_field('address') . '：</lable>' . $this->address . '</div>
<div><lable>' . admin_trans_field('app_sign') . '：</lable>' . $this->app_sign . '</div>';
                $html = '<table class="table custom-data-table data-table"><thead>';
                $html .= '<tr>';
                $html .= '<th>注册时间</th>';
                $html .= '<th>注册ip</th>';
                $html .= '<th>登录状态</th>';
                $html .= '<th>最后的登录时间</th>';
                $html .= '<th>最后的登录ip</th>';
                $html .= '</tr></thead>';

                $html .= '<tr>';
                $html .= '<td>'.$this->created_at.'</td>';
                $html .= '<td>'.$this->ip.'</td>';
                $html .= '<td></td>';
                $html .= '<td>'.$this->last_login_time.'</td>';
                $html .= '<td>'.$this->last_login_ip.'</td>';
                $html .= '</tr>';
                $html .='</table>';

                $card = new Card(null, $html);
                return "<div style='padding:10px 10px 0'>$card</div>";
            });
            //$grid->column('ip');
            //$grid->column('last_login_ip');
            //$grid->column('last_login_time');
            //$grid->column('created_at');

            $grid->disableFilterButton();
            $grid->filter(function (Grid\Filter $filter) {
                $filter->expand();
                $filter->equal('open_id')->width(3);
                $filter->where('id', function ($query) {
                    $query->where('gc_openid', $this->input)->orWhere('gg_openid', $this->input);
                }, admin_trans('package.fields.plugin_login') . 'id')->width(3);
                //$filter->equal('email')->width(3);
            });
        });
    }
}
