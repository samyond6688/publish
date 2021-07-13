<?php

namespace App\Admin\Action;

use App\Admin\Forms\EditCostProductForm as CostProductForm;
use Dcat\Admin\Widgets\Modal;
use Dcat\Admin\Grid\RowAction;

class EditCostProduct extends RowAction
{
    protected $title = '计费点';

    public function render()
    {
        // 实例化表单类并传递自定义参数
        $form = CostProductForm::make()->payload(['id' => $this->getKey()]);
        return Modal::make()
            ->lg()
            ->title($this->title)
            ->body($form)
            ->button($this->title);
    }
}