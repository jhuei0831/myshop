<?php

namespace App\Admin\Controllers;

use App\OrderItem;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class OrderitemController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'App\OrderItem';
    public function index(Content $content)
    {
        return $content
            ->header('訂單內容管理')
            ->description('管理所有訂單內容')
            ->body($this->grid());
    }
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new OrderItem);

        // $grid->column('id', __('Id'));
        $grid->column('order_id', __('Order id'));
        $grid->column('product_id', __('Product id'));
        $grid->product()->title(__('Title'));
        $grid->column('amount', __('Amount'));
        $grid->column('discount', __('Discount'));
        $grid->column('price', __('牌價'));
        $grid->filter(function ($filter) {
            // 去掉默認的id過濾器
            $filter->disableIdFilter();
            // 在這里添加字段過濾器
            $filter->like('order_id', __('Order id'));
            $filter->like('product_id', __('Product id'));

        });
        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(OrderItem::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('order_id', __('Order id'));
        $show->field('product_id', __('Product id'));
        $show->field('amount', __('Amount'));
        $show->field('price', __('Price'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new OrderItem);

        $form->number('order_id', __('Order id'));
        $form->number('product_id', __('Product id'));
        $form->number('amount', __('Amount'));
        $form->text('discount', __('Discount'));
        $form->number('price', __('Price'));

        return $form;
    }
}
