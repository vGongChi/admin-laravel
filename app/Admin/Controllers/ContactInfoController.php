<?php

namespace App\Admin\Controllers;

use App\Models\ContactInfo;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ContactInfoController extends AdminController
{
    protected $title = '联系我们管理';

    protected function grid()
    {
        $grid = new Grid(new ContactInfo());
        $grid->column('id', __('ID'))->sortable();
        $grid->column('language', __('语言'))->label();
        $grid->column('title', __('标题'));
        $grid->column('company_name', __('公司名称'));
        $grid->column('phone', __('电话'));
        $grid->column('mobile', __('联系电话'));
        $grid->column('email', __('邮箱'));
        $grid->column('address', __('地址'))->limit(40);
        $grid->column('qr_code', __('二维码'))->image('', 100, 100);
        $grid->column('created_at', __('创建时间'));

        $grid->filter(function ($filter) {
            $filter->equal('language', '语言')->select(['zh' => '中文', 'en' => '英语', 'rus' => '俄语']);
            $filter->like('company_name', '公司名称');
        });

        return $grid;
    }

    protected function detail($id)
    {
        $show = new Show(ContactInfo::findOrFail($id));

        $show->field('id', __('ID'));
        $show->field('language', __('语言'));
        $show->field('title', __('标题'));
        $show->field('company_name', __('公司名称'));
        $show->field('phone', __('电话'));
        $show->field('mobile', __('联系电话'));
        $show->field('email', __('邮箱'));
        $show->field('address', __('地址'));
        $show->field('qr_code', __('二维码'))->image();
        $show->field('created_at', __('创建时间'));
        $show->field('updated_at', __('更新时间'));

        return $show;
    }

    protected function form()
    {
        $form = new Form(new ContactInfo());

        $form->select('language', __('语言'))->options(['zh' => '中文', 'en' => '英语', 'rus' => '俄语'])->default('zh')->rules('required');
        $form->text('title', __('标题'));
        $form->text('company_name', __('公司名称'))->rules('required');
        $form->text('phone', __('电话'));
        $form->text('mobile', __('联系电话'));
        $form->email('email', __('邮箱'));
        $form->text('address', __('地址'));
        $form->image('qr_code', __('二维码'));
        $form->display('created_at', __('创建时间'));
        $form->display('updated_at', __('更新时间'));

        return $form;
    }
}
