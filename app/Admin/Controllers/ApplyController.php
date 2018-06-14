<?php

namespace App\Admin\Controllers;

use App\Models\Apply,App\Models\Article;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Illuminate\Http\Request;
class ApplyController extends Controller
{
    use ModelForm;

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {
        return Admin::content(function (Content $content){
            $content->header('加盟申请');
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
            $content->header('加盟申请');
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
            $content->header('加盟申请');
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

        return Admin::grid(Apply::class, function (Grid $grid) use ($request){
            $grid->disableExport();//禁止导出
            $grid->disableFilter();//禁止筛选
            $grid->disableCreateButton();//禁止创建按钮
            //默认排序
            $grid->model()->orderBy('created_at','DESC')->orderBy('id','DESC');
            $grid->id('ID')->sortable();
            $grid->column('name',"姓名");
            $grid->column('phone',"联系电话");
            $grid->ArticleTo()->title('报名课程');
            // $grid->column('age',"年龄");
            // $grid->column('address',"联系地址")->sortable();
            
        });

    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(Apply::class, function (Form $form) use ($cate_id){
            $form->display('name', '姓名');
            $form->display('phone', '联系电话');
            // $form->display('age', '年龄');
            // $form->display('address', '联系地址');
            // $form->display('years', '学画时间')->with(function ($value) {
            //     switch ($value) {
            //         case '1':
            //             return '半年';
            //             break;
            //         case '2':
            //             return '半年至一年';
            //             break;
            //         case '3':
            //             return '一年以上';
            //             break;
            //     }
            // });
            $form->display('course_id', '报名的课程')->with(function ($value) {
                if($value>0){
                    $article = Article::find($value);
                    return $article['title'];
                }else{
                    return "无";
                }
            });
            
        });
    }
}
