<?php

namespace App\Admin\Controllers;

use App\Models\Partner;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;
use Dcat\Admin\Widgets\Card;

class PartnerController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Partner(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('name');
            $grid->column('partner_type')->display(function($value){
                $str = '';
                foreach ($value as $item){
                    $str .= '<label>'.Partner::$partnerType[$item].'</label>';
                }
                return $str;
                //return Partner::$partnerType[$value];
            });
            $grid->column('invoice',admin_trans_field('other_info'))->display(admin_trans_field('look'))->modal(function ($modal) {
                // 设置弹窗标题
                $modal->title($this->name .' '.admin_trans_label('detail'));

                // 自定义图标
                $modal->icon('');
                //dump($this->tax_id_label);
                $html = '';
                $html .= '<br /><h3>'.admin_trans_label('tax_item_info').'</h3>';
                $html .= '<div>'.admin_trans_field('tax_id_label').'：'.$this->tax_id_label.'</div>';
                $html .= '<div>'.admin_trans_field('tax_address').'：'.$this->tax_address.'</div>';
                $html .= '<div>'.admin_trans_field('tax_bank').'：'.$this->tax_bank.'</div>';
                $html .= '<div>'.admin_trans_field('tax_bank_account').'：'.$this->tax_bank_account.'</div>';
                $html .= '<div>'.admin_trans_field('tax_mobile').'：'.$this->tax_mobile.'</div>';
                $html .= '<br /><h3>'.admin_trans_label('collection_info').'</h3>';
                $tax_item_type = '';
                foreach (json_decode($this->tax_item_type,true) ??[] as $item){
                    $tax_item_type .= '<label>'.Partner::$partnerItems[$item].'</label>';
                }
                $html .= '<div>'.admin_trans_field('tax_item_type').'：'.$tax_item_type.'</div>';
                $html .= '<br /><h3>'.admin_trans_label('addressee_info').'</h3>';
                $html .= '<div>'.admin_trans_field('collection_bank').'：'.$this->collection_bank.'</div>';
                $html .= '<div>'.admin_trans_field('collection_bank_account').'：'.$this->collection_bank_account.'</div>';
                $html .= '<div>'.admin_trans_field('collection_desc').'：'.$this->collection_desc.'</div>';
                $html .= '<div>'.admin_trans_field('addressee_name').'：'.$this->addressee_name.'</div>';
                $html .= '<div>'.admin_trans_field('addressee_address').'：'.$this->addressee_address.'</div>';
                $html .= '<div>'.admin_trans_field('addressee_desc').'：'.$this->addressee_mobile.'</div>';
                $html .= '<div>'.admin_trans_field('addressee_mobile').'：'.$this->addressee_mobile.'</div>';
                $card = new Card(null, $html);

                return "<div style='padding:10px 10px 0'>$card</div>";
            });;
            //$grid->column('created_at');
            $grid->column('status')->switch();
            //$grid->column('updated_at')->sortable();
            $grid->disableFilterButton();//按钮不用显示

            $grid->filter(function (Grid\Filter $filter) {
                $filter->expand();
                $filter->equal('name')->width(3);
                $filter->where('partner_type', function ($query) {
                    foreach ($this->input as $key =>$item){
                        $query->whereRaw('FIND_IN_SET(?,partner_type)',[$item],'or');
                   }

                }, admin_trans_field('partner_type'))->width(3)->multipleSelect(Partner::$partnerType);
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
        return Show::make($id, new Partner(), function (Show $show) {
            $show->field('id');
            $show->field('id');
            $show->field('name');
            $show->field('partner_type');
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
        return Form::make(new Partner(), function (Form $form) {
            //$form->display('id');
            $form->text('name')->rules('required|unique:partners');
            $form->checkbox('partner_type')->options(Partner::$partnerType)->saving(function ($value) {
                // 转化成json字符串保存到数据库
                return implode(',',$value);
            })->canCheckAll();


            $model = $form->model();
            $form->embeds("invoice", admin_trans_label('tax_item_info'), function ($form) use($model){
                $form->text('tax_id_label')->value($model->tax_id_label);
                $form->text('tax_address')->value($model->tax_address);
                $form->text('tax_bank')->value($model->tax_bank);
                $form->text('tax_bank_account')->value($model->tax_bank_account);
                $form->text('tax_mobile')->value($model->tax_mobile);
                $values = json_decode($model->tax_item_type,true) ?:[];
                $form->multipleSelect('tax_item_type')->default($values, true)->options(Partner::$partnerItems);

            });
            $form->embeds("invoice",admin_trans_label('collection_info'), function ($form) use($model){
                $form->text('collection_bank')->value($model->collection_bank);
                $form->text('collection_bank_account')->value($model->collection_bank_account);
                $form->textarea('collection_desc')->rows(3)->value($model->collection_desc);
            });
            $form->embeds("invoice",admin_trans_label('addressee_info'), function ($form) use($model){
                $form->text('addressee_name')->value($model->addressee_name);
                $form->text('addressee_address')->value($model->addressee_address);
                $form->textarea('addressee_desc')->rows(3)->value($model->addressee_desc);
                $form->text('addressee_mobile')->value($model->addressee_mobile);
            });
            $form->hidden('status')->default(1);
            $form->display('created_at');
            $form->display('updated_at');



            $form->disableViewButton();
            $form->saving(function (Form $form) {
                $invoices = $form->input('invoice');
                if($invoices){
                    foreach ($invoices as $key => $value){
                        if($key=='tax_item_type'){
                            $form->$key = json_encode(array_filter($value));
                        }else{
                            $form->$key = $value;
                        }

                    }
                    $form->deleteInput('invoice');
                }
            });
            $form->saved(function (Form $form) {
            });
        });
    }
}
