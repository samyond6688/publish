<?php

namespace App\Admin\Forms;

use App\Models\Cate;
use App\Models\CostProduct;
use Dcat\Admin\Admin;
use Dcat\Admin\Form\NestedForm;
use Dcat\Admin\Traits\LazyWidget;
use Dcat\Admin\Widgets\Form;
use Dcat\Admin\Contracts\LazyRenderable;

class EditCostProductForm extends Form implements LazyRenderable
{
    use LazyWidget; // 使用异步加载功能

    // 处理请求
    public function handle(array $input)
    {
        $CostProduct = new CostProduct();
        $params = $input['params'];
        // 获取外部传递参数
        $cate_id = $input['cate_id'] ?? null;
        if (!$cate_id) {
            return $this->response()->error('参数错误');
        }

        $ids = $CostProduct::where('cate_id',$cate_id)->pluck('id')->toArray();
        foreach ($params as $item){
            if($item['id']){
                $CostProduct->where(['id'=>$item['id']])->update(array_diff_key($item,['id'=>'']));
            }else{
                $CostProduct->cate_id = $cate_id;
                $CostProduct->product_id = $item['product_id'];
                $CostProduct->amount = $item['amount'];
                $CostProduct->is_subscribe = $item['is_subscribe'];
                $CostProduct->save();
            }
        }
        $dels = array_diff($ids,array_filter(array_column($params,'id')));
        if($dels){
            $CostProduct::wherein('id',$dels)->delete();
        }


        return $this->response()->success('更新成功');
    }

    public function form()
    {
        $Cate = new Cate();
        // 获取外部传递参数
        $id = $this->payload['id'] ?? null;
        $data = $Cate::where('id',$id)->get();
        $this->hidden('cate_id')->default($id,true);
        $this->width('1050px;');
        $this->setFormId('cost_product');
        $this->table('params', function (NestedForm $table) {
            $table->hidden('id');
            $table->text('product_id')->label(admin_trans('cost-product.fields.product_id'));
            $table->text('amount')->label(admin_trans('cost-product.fields.amount'));
            $table->switch('is_subscribe')->label(admin_trans('cost-product.fields.is_subscribe'));
        })->label($data ? $data[0]->name : '');

        Admin::script($this->form_script());

    }
    protected function form_script(){
        //
        return <<<JS
        
            
JS;
    }

    // 返回表单数据，如不需要可以删除此方法
    public function default()
    {
        $CostProduct = new CostProduct();
        // 获取外部传递参数
        $id = $this->payload['id'] ?? null;
        return [
            'params' => json_encode($CostProduct->where(['cate_id'=>$id])->select()->get())
        ];
    }

    public function paramer(){

    }
}