<?php

namespace App\Admin\Controllers;

use App\Page;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class PageController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'App\Page';
    public function index(Content $content)
    {
        return $content
            ->header('頁面管理')
            ->description('管理所有前台頁面')
            ->body($this->grid());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Page);

        $grid->column('id', __('Id'));
        $grid->column('name', __('網頁名稱'));
        $grid->column('title', __('標題'));
        // $grid->column('content', __('內容'));
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
        $show = new Show(Page::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('title', __('Title'));
        $show->field('content', __('Content'));
        $show->field('is_open', __('Is open'));
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
        $form = new Form(new Page);

        $form->text('name', __('網頁名稱'))->rules('required');
        $form->text('title', __('標題'))->rules('required');
        $form->summernote('content', __('內容'))->rules('required');
        $states = [
            'on' => ['value' => 1, 'text' => '是', 'color' => 'success'],
            'off' => ['value' => 0, 'text' => '否', 'color' => 'danger'],
        ];
        $form->switch('is_open', __('是否開放'))->states($states)->default(1);

        return $form;
    }
}
