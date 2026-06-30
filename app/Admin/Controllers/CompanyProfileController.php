<?php

namespace App\Admin\Controllers;

use App\Models\CompanyProfile;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class CompanyProfileController extends AdminController
{
    protected $title = '公司简介管理';

    protected function grid()
    {
        $grid = new Grid(new CompanyProfile());
        $grid->column('id', __('ID'))->sortable();
        $grid->column('language', __('语言'))->label();
        $grid->column('title', __('标题'));
        $grid->column('title_en', __('英文标题'));
        $grid->column('description', __('简介'))->limit(50);
        $grid->column('link', __('链接'));
        $grid->column('image', __('图片'))->image('', 100, 50);
        $grid->column('created_at', __('创建时间'));

        $grid->filter(function ($filter) {
            $filter->equal('language', '语言')->select(['zh' => '中文', 'en' => '英语', 'rus' => '俄语']);
            $filter->like('title', '标题');
        });

        return $grid;
    }

    protected function detail($id)
    {
        $show = new Show(CompanyProfile::findOrFail($id));

        $show->field('id', __('ID'));
        $show->field('language', __('语言'));
        $show->field('title', __('标题'));
        $show->field('title_en', __('英文标题'));
        $show->field('description', __('简介'));
        $show->field('link', __('链接'));
        $show->field('image', __('图片'))->image();
        $show->field('created_at', __('创建时间'));
        $show->field('updated_at', __('更新时间'));

        return $show;
    }

    protected function form()
    {
        $form = new Form(new CompanyProfile());

        $form->select('language', __('语言'))->options(['zh' => '中文', 'en' => '英语', 'rus' => '俄语'])->default('zh')->rules('required');
        $form->text('title', __('标题'))->rules('required');
        $form->text('title_en', __('英文标题'));
        $form->textarea('description', __('简介'))->rules('required');
        $form->text('link', __('链接'));
        $form->image('image', __('图片'));
        $form->editor('content', __('内容'));
        $form->display('created_at', __('创建时间'));
        $form->display('updated_at', __('更新时间'));

        return $form;
    }
}
