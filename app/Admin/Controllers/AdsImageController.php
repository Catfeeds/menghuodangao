<?php

namespace App\Admin\Controllers;

use App\Models\AdsPosition,App\Models\AdsImage;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Illuminate\Http\Request;
class AdsImageController extends Controller
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
            $content->header('广告图');
            $content->description('广告图');
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
            $content->header('广告图');
            $content->description('广告图');
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
            $content->header('广告图');
            $content->description('广告图');
            $content->body($this->form($request['cate_id']));
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid($request)
    {

        return Admin::grid(AdsImage::class, function (Grid $grid) use ($request){
            $grid->disableExport();//禁止导出
            $grid->disableFilter();//禁止筛选
            //默认排序
            $grid->model()->orderBy('order','DESC');
            $grid->id('ID')->sortable();
            $grid->AdsPositionTo()->title('广告位');
            $grid->column('alt',"alt");
            $grid->image("图片")->image();
            $grid->column('url',"链接");
            $grid->column('order',"排序")->sortable();

            $grid->urlCreateButton('/admin/ads-image/create?cate_id='.$request['cate_id']);//修改添加按钮链接
            $grid->filter(function ($filter) {
                $filter->equal('cate_id','分类')->select();
            });
        });

    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form($cate_id=0)
    {
        return Admin::form(AdsImage::class, function (Form $form) use ($cate_id){
            $form->tools(function (Form\Tools $tools) {
                // 去掉跳转列表按钮
                $tools->disableListButton();
            });
            $form->text('title', '标题');
            $form->text('desc', '描述');
            $form->hidden('cate_id','分类')->value($cate_id);
            $form->text('alt', 'alt');
            $form->number('order', '排序');
            $form->text('url', '链接');
            $form->image('image','图片')->move('/uploads/images/'.date('Ymd'))->uniqueName();

            // $form->setAction('/admin/ads-image');//提交地址

            $form->saving(function (Form $form) {
                $AdsPosition = AdsPosition::find($form->cate_id);
                $form->image = Image($form->image,$AdsPosition['width'],$AdsPosition['height'],"uploads/images/".date("Ymd")."/");
            });
            $form->saved(function (Form $form) {
                admin_toastr(trans('admin.update_succeeded'));
                return redirect('/admin/ads-image?cate_id='.$form->cate_id);
            });
        });
    }
}
