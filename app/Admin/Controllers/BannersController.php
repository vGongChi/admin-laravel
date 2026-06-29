<?php

namespace App\Admin\Controllers;

use App\Models\Banner;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class BannersController extends AdminController
{
    protected $title = 'Banner 管理';

    protected function grid()
    {
        $grid = new Grid(new Banner());
        $grid->column('id', __('ID'))->sortable();
        $grid->column('language', __('语言'))->label();
        $grid->column('title', __('标题'));
        $grid->column('image_large', __('大图'))->image('', 100, 50);
        $grid->column('image_small', __('小图'))->image('', 100, 50);
        $grid->column('link', __('跳转链接'));
        $grid->column('sort', __('排序'))->sortable();
        $grid->column('status', __('状态'))->using([0 => '隐藏', 1 => '显示'])->dot([0 => 'danger', 1 => 'success']);
        $grid->column('created_at', __('创建时间'));

        $grid->filter(function ($filter) {
            $filter->equal('language', '语言')->select(['zh' => '中文', 'en' => '英语', 'ja' => '日语']);
            $filter->like('title', '标题');
            $filter->equal('status', '状态')->select([1 => '显示', 0 => '隐藏']);
        });

        return $grid;
    }

    protected function detail($id)
    {
        $show = new Show(Banner::findOrFail($id));

        $show->field('id', __('ID'));
        $show->field('language', __('语言'));
        $show->field('title', __('标题'));
        $show->field('image_large', __('大图'))->image();
        $show->field('image_small', __('小图'))->image();
        $show->field('link', __('跳转链接'));
        $show->field('sort', __('排序'));
        $show->field('status', __('状态'))->using([0 => '隐藏', 1 => '显示']);
        $show->field('created_at', __('创建时间'));
        $show->field('updated_at', __('更新时间'));

        return $show;
    }

    protected function form()
    {
        $form = new Form(new Banner());
        $form->select('language', __('语言'))->options(['zh' => '中文', 'en' => '英语', 'ja' => '日语'])->default('zh')->rules('required');
        $form->text('title', __('标题'));
        $form->image('image_large', __('大图'))->rules('required|image');
        $form->image('image_small', __('小图'))->rules('required|image');
        $form->url('link', __('跳转链接'));
        $form->number('sort', __('排序'))->default(0);
        $form->switch('status', __('状态'))->states([0 => ['value' => 0, 'text' => '隐藏', 'color' => 'danger'], 1 => ['value' => 1, 'text' => '显示', 'color' => 'success']])->default(1);
        $form->display('created_at', __('创建时间'));
        $form->display('updated_at', __('更新时间'));

        return $form;
    }
}
