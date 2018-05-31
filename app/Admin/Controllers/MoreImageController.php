<?php

namespace App\Admin\Controllers;

use App\Models\MoreImage;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Illuminate\Http\Request;
class MoreImageController extends Controller
{
    use ModelForm;

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index(Request $request)
    {
        return Admin::content(function (Content $content) use ($request){
            $content->header('图片');
            $content->body($this->grid($request));
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
            $content->header('图片');
            $content->body($this->form()->edit($id));
        });
    }

    /**
     * Create interface.
     *
     * @return Content
     */
    public function create(Request $request)
    {
        return Admin::content(function (Content $content) use ($request){
            $content->header('图片');
            $content->body($this->form($request));
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid($request=array())
    {

        return Admin::grid(MoreImage::class, function (Grid $grid) use ($request){
            $grid->disableExport();//禁止导出
            $grid->disableFilter();//禁止筛选
            //默认排序
            $grid->model()->orderBy('order','DESC');
            $grid->id('ID')->sortable();
            $grid->column('alt',"alt");
            $grid->image("图片")->image();
            // $grid->column('url',"链接");
            $grid->column('order',"排序")->sortable();

            $grid->urlCreateButton('/admin/more-image/create?cate_id='.$request['cate_id'].'&more_id='.$request['more_id']);//修改添加按钮链接
            $grid->filter(function ($filter) {
                $filter->equal('cate_id','分类')->select();
                $filter->equal('more_id','分类')->select();
            });
        });

    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form($request=array())
    {
        return Admin::form(MoreImage::class, function (Form $form) use ($request){
            $form->tools(function (Form\Tools $tools) {
                // 去掉跳转列表按钮
                $tools->disableListButton();
            });
            $form->hidden('cate_id','分类')->value($request['cate_id']);
            $form->hidden('more_id','分类')->value($request['more_id']);

            $form->text('alt', 'alt');
            $form->number('order', '排序');
            // $form->text('url', '链接');
            $form->image('image','图片')->move('/uploads/images/'.date('Ymd'))->uniqueName();

            // $form->setAction('/admin/ads-image');//提交地址

            $form->saving(function (Form $form) {
                // $AdsPosition = AdsPosition::find($form->cate_id);
                // $form->image = Image($form->image,$AdsPosition['width'],$AdsPosition['height'],"uploads/images/".date("Ymd")."/");
            });
            $form->saved(function (Form $form) {
                admin_toastr(trans('admin.update_succeeded'));
                return redirect('/admin/more-image?cate_id='.$form->cate_id.'&more_id='.$form->more_id);
            });
        });
    }
}
