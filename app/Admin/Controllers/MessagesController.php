<?php

namespace App\Admin\Controllers;

use App\Models\Message;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class MessagesController extends AdminController
{
    protected $title = '留言管理';

    protected function grid()
    {
        $grid = new Grid(new Message());
        $grid->column('id', __('ID'))->sortable();
        $grid->column('name', __('姓名'));
        $grid->column('phone', __('电话'));
        $grid->column('email', __('邮箱'));
        $grid->column('address', __('地址'))->limit(30);
        $grid->column('message', __('留言'))->limit(50);
        $grid->column('status', __('状态'))->using([0 => '未处理', 1 => '已处理'])->dot([0 => 'danger', 1 => 'success']);
        $grid->column('created_at', __('提交时间'));

        $grid->filter(function ($filter) {
            $filter->like('name', '姓名');
            $filter->equal('status', '状态')->select([0 => '未处理', 1 => '已处理']);
        });

        return $grid;
    }

    protected function detail($id)
    {
        $show = new Show(Message::findOrFail($id));

        $show->field('id', __('ID'));
        $show->field('name', __('姓名'));
        $show->field('phone', __('电话'));
        $show->field('email', __('邮箱'));
        $show->field('address', __('地址'));
        $show->field('message', __('留言'));
        $show->field('ip', __('IP'));
        $show->field('user_agent', __('浏览器信息'));
        $show->field('status', __('状态'))->using([0 => '未处理', 1 => '已处理']);
        $show->field('created_at', __('提交时间'));
        $show->field('updated_at', __('更新时间'));

        return $show;
    }

    protected function form()
    {
        $form = new Form(new Message());

        $form->text('name', __('姓名'))->rules('required');
        $form->text('phone', __('电话'));
        $form->email('email', __('邮箱'));
        $form->text('address', __('地址'));
        $form->textarea('message', __('留言'))->rules('required');
        $form->text('ip', __('IP'));
        $form->text('user_agent', __('浏览器信息'));
        $form->switch('status', __('状态'))->states([0 => ['value' => 0, 'text' => '未处理', 'color' => 'danger'], 1 => ['value' => 1, 'text' => '已处理', 'color' => 'success']])->default(0);
        $form->display('created_at', __('提交时间'));
        $form->display('updated_at', __('更新时间'));

        return $form;
    }
}
