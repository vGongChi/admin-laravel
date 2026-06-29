<?php

namespace App\Admin\Controllers;

use App\Models\SiteConfig;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class SiteConfigController extends AdminController
{
    protected $title = '站点配置管理';

    protected function grid()
    {
        $grid = new Grid(new SiteConfig());
        $grid->column('id', __('ID'))->sortable();
        $grid->column('key_name', __('配置键'));
        $grid->column('language', __('语言'))->display(function ($language) {
            return $language ?: '通用';
        })->label();
        $grid->column('value', __('配置值'))->limit(50);
        $grid->column('created_at', __('创建时间'));

        $grid->filter(function ($filter) {
            $filter->like('key_name', '配置键');
            $filter->equal('language', '语言')->select(['zh' => '中文', 'en' => '英语', 'ja' => '日语']);
        });

        return $grid;
    }

    protected function detail($id)
    {
        $show = new Show(SiteConfig::findOrFail($id));

        $show->field('id', __('ID'));
        $show->field('key_name', __('配置键'));
        $show->field('language', __('语言'))->as(function ($language) {
            return $language ?: '通用';
        });
        $show->field('value', __('配置值'));
        $show->field('created_at', __('创建时间'));
        $show->field('updated_at', __('更新时间'));

        return $show;
    }

    protected function form()
    {
        $form = new Form(new SiteConfig());

        $form->text('key_name', __('配置键'))->rules('required');
        $form->select('language', __('语言'))->options(['' => '通用', 'zh' => '中文', 'en' => '英语', 'ja' => '日语'])->default('');
        $form->textarea('value', __('配置值'))->rules('required');
        $form->display('created_at', __('创建时间'));
        $form->display('updated_at', __('更新时间'));

        return $form;
    }
}
