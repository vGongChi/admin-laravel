<?php

namespace App\Admin\Controllers;

use App\Models\Navigation;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class NavigationController extends AdminController
{
    protected $title = '导航管理';

    protected function grid()
    {
        $grid = new Grid(new Navigation());
        $grid->column('id', __('ID'))->sortable();
        $grid->column('language', __('语言'))->label();
        $grid->column('parent.name', __('父级'))->display(function ($value) {
            return $value ?: '顶级';
        });
        $grid->column('name', __('名称'));
        $grid->column('url', __('链接'));
        $grid->column('sort', __('排序'))->sortable();
        $grid->column('status', __('状态'))->using([0 => '隐藏', 1 => '显示'])->dot([0 => 'danger', 1 => 'success']);
        $grid->column('created_at', __('创建时间'));
        $grid->column('name_en', __('英文标题'));
        $grid->column('image', __('图片'))->image();

        $grid->filter(function ($filter) {
            $filter->equal('language', '语言')->select(['zh' => '中文', 'en' => '英语', 'ja' => '日语']);
            $filter->like('name', '名称');
        });

        return $grid;
    }

    protected function detail($id)
    {
        $show = new Show(Navigation::findOrFail($id));

        $show->field('id', __('ID'));
        $show->field('language', __('语言'));
        $show->field('parent.name', __('父级'))->as(function ($value) {
            return $value ?: '顶级';
        });
        $show->field('name', __('名称'));
        $show->field('url', __('链接'));
        $show->field('sort', __('排序'));
        $show->field('status', __('状态'))->using([0 => '隐藏', 1 => '显示']);
        $show->field('created_at', __('创建时间'));
        $show->field('updated_at', __('更新时间'));
        $show->field('name_en', __('英文标题'));
        $show->field('image', __('图片'))->image();
        $show->field('content', __('内容'))->unescape();

        return $show;
    }

    protected function form()
    {
        $form = new Form(new Navigation());

        $form->select('language', __('语言'))->options(['zh' => '中文', 'en' => '英语', 'ja' => '日语'])->default('zh')->rules('required');
        $form->select('parent_id', __('父级'))->options([0 => '顶级'] + Navigation::pluck('name', 'id')->toArray())->default(0);
        $form->text('name', __('名称'))->rules('required');
        $form->url('url', __('链接'))->rules('nullable|url');
        $form->number('sort', __('排序'))->default(0);
        $form->switch('status', __('状态'))->states([0 => ['value' => 0, 'text' => '隐藏', 'color' => 'danger'], 1 => ['value' => 1, 'text' => '显示', 'color' => 'success']])->default(1);
        $form->text('name_en', __('英文标题'));
        $form->image('image', __('图片'));
        $form->editor('content');

        $form->display('created_at', __('创建时间'));
        $form->display('updated_at', __('更新时间'));

        // $form->html('<link rel="stylesheet" href="/vendor/wangEditor-3.0.9/release/wangEditor.min.css">');
        // $form->html('<script src="/vendor/wangEditor-3.0.9/release/wangEditor.min.js"></script>');
        // $form->html('<script>$(document).ready(function() { const E = window.wangEditor; const editor = new E("#wang-editor"); editor.create(); });</script>');

        $form->saving(function (Form $form) {
            if ($form->model()->id && $form->parent_id == $form->model()->id) {
                throw new \Exception('父级导航不能选择自己');
            }
            if ($form->url === null) {
                $form->url = '';
            }
        });

        return $form;
    }
}
