<?php

namespace App\Admin\Controllers;

use App\User;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Http\Controllers\Controller;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
class UsersController extends Controller
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'App\User';

    public function index()
    {
        return Admin::content(function (Content $content) {
            // 页面标题
            $content->header('用户列表');
            $content->body($this->grid());
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new User);
        // 创建一个列名为 ID 的列，内容是用户的 id 字段，并且可以在前端页面点击排序
        $grid->column('id', __('Id'))->sortable();
        // 创建一个列名为 用户名 的列，内容是用户的 name 字段
        $grid->column('name', __('用户名'));
        $grid->column('email', __('邮箱'));
        $grid->email_verified('已验证邮箱')->display(function ($value) {
                return $value ? '是' : '否';
            });
        $grid->column('password', __('Password'));
        $grid->column('remember_token', __('Remember token'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
         // 不在页面显示 `新建` 按钮，因为我们不需要在后台新建用户
        $grid->disableCreateButton();

        $grid->actions(function ($actions) {
                // 不在每一行后面展示查看按钮
                $actions->disableView();

                // 不在每一行后面展示删除按钮
                $actions->disableDelete();

                // 不在每一行后面展示编辑按钮
                $actions->disableEdit();
        });
        $grid->tools(function ($tools) {

                // 禁用批量删除按钮
                $tools->batch(function ($batch) {
                    $batch->disableDelete();
                });
        });
        return $grid;
    }

   

   
}
