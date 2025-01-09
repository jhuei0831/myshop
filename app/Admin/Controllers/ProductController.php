<?php

namespace App\Admin\Controllers;

use App\Product;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Illuminate\Support\Str;
use Dcat\Admin\Layout\Content;
use Dcat\Admin\Http\Controllers\AdminController;

class ProductController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'App\Product';

    public function index(Content $content)
    {
        return $content
            ->header('商品管理')
            ->description('管理所有賣場商品')
            ->body($this->grid());
    }
    
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Product);

        $grid->column('id', __('Id'));
        $grid->column('title', __('Title'));
        $grid->column('description', __('Description'))->display(function ($text) {
            return Str::limit($text, 80, '...');
        });
        $grid->column('image', __('Image'))->display(function ($text) {
            return Str::limit($text, 30, '...');
        });
        $grid->column('on_sale', __('On sale'));
        $grid->column('price', __('Price'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

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
        $show = new Show(Product::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('title', __('Title'));
        $show->field('description', __('Description'));
        $show->field('image', __('Image'));
        $show->field('on_sale', __('On sale'));
        $show->field('price', __('Price'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }
    public function edit($id, Content $content)
    {
        return $content
            ->header('編輯商品')
            ->description('可於此頁面修改商品內容')
            ->body($this->form()->edit($id));
    }
    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Product);

        $form->text('title', __('Title'))->rules('required');
        $form->editor('description', __('Description'))->rules('required');
        $form->image('image', __('Image'))->rules('required');
        $form->radio('on_sale', __('On sale'))->options(['是', '否'])->default(0);;
        $form->number('price', __('Price'))->default(0)->rules('required|integer|min:0');

        return $form;

    }
}
