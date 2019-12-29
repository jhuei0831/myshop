<?php

namespace App\Admin\Controllers;

use App\Photo;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class PhotoController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'App\Photo';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Photo);

        $grid->column('id', __('Id'));
        $grid->column('title', __('輪播標題'));
        $grid->column('description', __('輪播敘述'));
        $grid->column('image', __('輪播圖片'));
        $grid->column('is_open', __('是否開放'))->bool();
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
        $show = new Show(Photo::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('title', __('輪播標題'));
        $show->field('description', __('輪播敘述'));
        $show->field('image', __('輪播圖片'));
        $show->field('is_open', __('是否開放'));
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
        $form = new Form(new Photo);

        $form->text('title', __('輪播標題'));
        $form->textarea('description', __('輪播敘述'));
        $form->image('image', __('輪播圖片'));
        $form->switch('is_open', __('是否開放'))->default(1);

        return $form;
    }
}
