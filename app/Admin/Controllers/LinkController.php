<?php

namespace App\Admin\Controllers;

use App\Models\Link;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class LinkController extends Controller
{
    use ModelForm;

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {
        return Admin::content(function (Content $content) {
            $content->header('设置');
            $content->description('友情链接');
            $content->body($this->grid());
        });
    }

    /**
     * Edit interface.
     *
     * @param $id
     * @return Content
     */
    public function edit($id)
    {
        return Admin::content(function (Content $content) use ($id) {
            $content->header('设置');
            $content->description('友情链接');
            $content->body($this->form()->edit($id));
        });
    }

    /**
     * Create interface.
     *
     * @return Content
     */
    public function create()
    {
        return Admin::content(function (Content $content) {
            $content->header('设置');
            $content->description('友情链接');
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
        return Admin::grid(Link::class, function (Grid $grid) {
            $grid->disableExport();//禁止导出
            $grid->disableFilter();//禁止筛选
            //默认排序
            $grid->model()->orderBy('order','DESC')->orderBy('id','DESC');

            $grid->id('ID')->sortable();
            $grid->column('title',"标题");
            $grid->column('order',"排序");
            $grid->column('url',"链接");
            
        });

    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(Link::class, function (Form $form) {
            $form->text('title', '标题')->rules('required');
            $form->text('url', '链接');
            $form->number('order','排序');
        });
    }
}
