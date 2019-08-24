<?php

namespace App\Admin\Controllers;

use App\Models\Banner;
// use Encore\Admin\Controllers\Controller;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Http\Request;
use Encore\Admin\Layout\Content;
use Encore\Admin\Controllers\ModelForm;
use Encore\Admin\Facades\Admin;
use App\Http\Controllers\Controller;

class BannerController extends Controller
{
    use ModelForm;
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'App\Models\Banner';


    public function index()
    {
        return Admin::content(function (Content $content) {
            $content->header('轮播图列表');
            $content->body($this->grid());
        });
    }

    public function create()
    {
        return Admin::content(function (Content $content) {
            $content->header('创建轮播');
            $content->body($this->form());
        });
    }
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Banner);

        $grid->column('id', __('Id'));
        $grid->column('image', __('图片'))->lightbox(['width' => 100, 'height' => 100]);
        
        $grid->column('on_show', __('已展示'))->display(function ($value) {
                return $value ? '是' : '否';
            });
        $grid->actions(function ($actions) {
            // 不展示默认的查看按钮
            $actions->disableView();
        });
        // $grid->column('created_at', __('Created at'));
        // $grid->column('updated_at', __('Updated at'));

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
        $show = new Show(Banner::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('image', __('Image'));
        $show->field('on_show', __('On show'));
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
        $form = new Form(new Banner);

        // 创建一个选择图片的框
        $form->image('image', '封面图片')->rules('required|image');
        // 创建一组单选框
        $form->radio('on_show', '展示')->options(['1' => '是', '0'=> '否'])->default('1');

        return $form;
    }

    public function edit($id)
    {
        return Admin::content(function (Content $content) use ($id) {
            $content->header('编辑轮播');
            $content->body($this->form()->edit($id));
        });
    }
   
}
