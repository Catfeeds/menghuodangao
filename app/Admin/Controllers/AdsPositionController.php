<?php

namespace App\Admin\Controllers;

use App\Models\AdsPosition;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class AdsPositionController extends Controller
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
            $content->header('广告图');
            $content->description('广告位');
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
            $content->header('广告图');
            $content->description('广告位');
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
            $content->header('广告图');
            $content->description('广告位');
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
        return Admin::grid(AdsPosition::class, function (Grid $grid) {
            $grid->disableExport();//禁止导出
            $grid->disableFilter();//禁止筛选
            //默认排序
            $grid->model()->orderBy('id','ASC');

            $grid->id('ID')->sortable();
            $grid->column('title',"标题");
            $grid->column('message',"说明");
            $grid->column('width',"图片宽度");
            $grid->column('height',"图片高度");
            // $grid->created_at();
            // $grid->updated_at();
            $grid->AdsImageMany('图片数量')->display(function ($comments) {
                $count = count($comments);
                return "<span class='label label-warning'>{$count}</span>";
            });
            $grid->actions(function ($actions) {
                $row = $actions->row;
                $actions->prepend('<a href="'.URL('/admin/ads-image').'?cate_id='.$row['id'].'"><i class="fa fa-image"></i></a>');
            });
        });

    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(AdsPosition::class, function (Form $form) {
            $form->text('title', '名称')->rules('required');
            $form->textarea('message', '说明')->rows(3);
            $form->number('width','图片宽度');
            $form->number('height','图片高度');
        });
    }
}
