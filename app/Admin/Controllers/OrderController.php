<?php

namespace App\Admin\Controllers;

use App\Models\Game;
use App\Models\Package;
use App\Models\Plugin;
use App\Models\Cate;
use App\Models\Order;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;
use Dcat\Admin\Widgets\Card;
use Illuminate\Support\Facades\DB;

class OrderController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $model = new Order();
        return Grid::make($model, function (Grid $grid) use ($model){
            $grid->model()->with(['package','cate','game']);
            //dd($grid);
            //$grid->column('id')->sortable();
            $grid->column('order_id')->limit(10);
            $grid->column('game_order_id');
            $grid->column('created_at');
            $grid->column('pay_amout');
            $grid->column('product_amout');
            $grid->column('product_id');
            $grid->column('currency_type');
            $grid->column('currency_type');
            $grid->column('amount','实充金额')->display(function () use ($model){

                //cp计费点（$）*（实充金额/下单金额）；精确到小数点后两位；
                return round($model->getAmount($this->product_id,[]) * ($this->pay_amout / $this->product_amout),2);
            });

            $grid->column('open_id')->limit(10);
            $grid->column('package.id','登录插件')->display(function(){
                $Plugin = new Plugin();
                $loginPluginIds = $this->package->plugin_login;
                //$payPluginIds = json_decode($package->plugin_pay,true);
                $ids = $loginPluginIds;
                $PluginData = DB::connection($Plugin->connection)->selectOne('select * from plugins where id in ('.$ids.')');
                return $PluginData ? ($Plugin::$nameConfig[$PluginData->name] ?: '') : '';
            });
            $grid->column('cate.name','游戏组')->display(function(){
                return $this->cate ? $this->cate->id .'-'.$this->cate->name : '';
            });
            $grid->column('game.name','游戏')->display(function(){
                return $this->game ? $this->game->id .'-'.$this->game->name : '';
            });
            $grid->column('package.name','游戏')->display(function(){
                return $this->package ? $this->package->id .'-'.$this->package->name : '';
            });
            $grid->column('udid');
            $grid->column('adid');
            //$grid->column('role_id');
            //$grid->column('role_name');
            //$grid->column('role_level');

            $grid->column('role_id', '角色详情')->display('详情')->expand(function (Grid\Displayers\Expand $expand) {
                $content = [
                    implode(':', [admin_trans_field('role_id'), $this->role_id]),
                    implode(':', [admin_trans_field('role_name'), $this->role_name]),
                    implode(':', [admin_trans_field('role_level'), $this->role_level]),
                ];
                $card = new Card(null, implode(',', $content));
                return "<div style='padding:10px 10px 0'>$card</div>";
            });


            $grid->column('game_product_id');


            $grid->column('pay_status')->using($model::$orderStatus);
            $grid->column('pay_type')->using($model::$payPlugin);
            //支付方式
            $grid->column('pay_no')->limit(10);
            $grid->column('ip');
            $grid->column('pay_finish_time');
            $grid->column('callcakc_success_time');
            $grid->column('created_date');


            $grid->disableFilterButton();//按钮不用显示
            $grid->filter(function (Grid\Filter $filter) {
                $filter->expand();
                $filter->panel();
                $CateModel = new Cate();
                $GameModel = new Game();
                $PackageModel = new Package();
                $PluginModel = new Plugin();
                $CateList = $CateModel->pluck('name', 'id');
                $GameList = $GameModel->pluck('name', 'id');
                $PackageList = $PackageModel->pluck('name', 'id');
                $PluginList = $PluginModel->pluck('name', 'id');
                $filter->between('created_at')->datetime()->width('4');
                $filter->equal('cate_id')->width(3)->multipleSelect($CateList);
                $filter->equal('game_id')->width(3)->multipleSelect($GameList);
                $filter->equal('package_id')->width(2);

                $filter->equal('pay_status')->width(3)->multipleSelect(Order::$orderStatus);
                $filter->equal('sdk_status','推送状态')->width(3)->multipleSelect(Order::$pushStatus);
                $filter->equal('pay_type')->width(3)->multipleSelect(Order::$orderType);
                $filter->equal('udid')->width(3);
                $filter->equal('open_id')->width(3);
                $filter->where('search', function ($query) {
                    $query->where('role_name', 'like', "%{$this->input}%")->orWhere('role_id',$this->input);

                }, '角色或id')->width(3);
                $filter->equal('order_id')->width(3);
                $filter->equal('game_order_id')->width(3);

                //登录插件
                /*$filter->where('plugin_id', function ($query) {
                    dd($_REQUEST['plugin_id']);
                    $package_ids = $PackageModel
                    $query->where('package_id', 'like', "%{$this->input}%")->orWhere('role_id',$this->input);

                }, '登录插件')->multipleSelect($PluginList);*/
            });


            $grid->showColumnSelector();
            // 设置默认隐藏字段
            $grid->hideColumns(['open_id', 'cate_id', 'game_id', 'package_id', 'udid', 'adid', 'ip', 'created_date','callcakc_success_time','currency_type']);

            $grid->setActionClass(Grid\Displayers\Actions::class);//设置操作类
            //$grid->disableActions();//禁用操作
            $grid->showViewButton();
            $grid->disableEditButton();
            $grid->disableCreateButton();
            $grid->enableDialogCreate();
        });
    }

    protected function detail($id)
    {
        $model = new Order();
        return Show::make($id, $model, function (Show $show) use ($model){
            $show->panel()
                ->title('订单详情');
            $show->row(function (Show\Row $show) {
                $show->width(3)->field('cate.name','游戏组')->as(function(){
                    if(!$this->cate) return '';
                    return $this->cate->id .'-'.$this->cate->name;
                });
                $show->width(3)->field('game.name','游戏')->as(function(){
                    if(!$this->game) return '';
                    return $this->game->id .'-'.$this->game->name;
                });
                $show->width(3)->field('package.name','游戏')->as(function(){
                    if(!$this->package) return '';
                    return $this->package->id .'-'.$this->package->name;
                });
            });
            $show->row(function (Show\Row $show) use ($model)  {
                $show->width(3)->role_id;
                $show->width(3)->role_name;
                $show->width(3)->role_level;
            });
            $show->row(function (Show\Row $show) use ($model) {
                $show->width(3)->pay_amout;
                $show->width(3)->product_amout;
                $show->width(3)->field('amount','实充金额')->as(function () use ($model){
                    //cp计费点（$）*（实充金额/下单金额）；精确到小数点后两位；
                    return round($model->getAmount($this->product_id,[]) * ($this->pay_amout / $this->product_amout),2);
                });;
            });
            $show->row(function (Show\Row $show) {
                $show->width(5)->order_id;
                $show->width(5)->game_order_id;
            });
            $show->row(function (Show\Row $show) {
                $show->width(5)->created_at;
                $show->width(5)->created_date;
            });

            $show->row(function (Show\Row $show) use ($model)  {
                $show->width(5)->currency_type;
                $show->width(5)->product_id;
            });

            $show->row(function (Show\Row $show) use ($model) {
                $show->width(5)->field('package.id','登录插件')->as(function(){

                    $Plugin = new Plugin();
                    $loginPluginIds = $this->package->plugin_login;
                    $ids = $loginPluginIds;

                    $PluginData = DB::connection($Plugin->connection)->selectOne('select * from plugins where id in ('.$ids.')');
                    return $PluginData ? ($Plugin::$nameConfig[$PluginData->name] ?: '') : '';
                });
                $show->width(5)->field('pay_type')->as(function() use($model){
                    return $model::$payPlugin[$this->pay_type] ??'未知';
                });

            });
            $show->divider();
            $show->row(function (Show\Row $show) use ($model) {
                $show->width(5)->field('sdk_status')->as(function() use($model){
                    return $model::$pushStatus[$this->sdk_status] ??'未知';
                });
                $show->width(5)->field('pay_status')->as(function() use($model){
                    return $model::$orderStatus[$this->pay_status] ??'未知';
                });;
            });


            $show->disableDeleteButton();
            $show->disableEditButton();
        });
    }

}
