<?php

namespace App\Admin\Controllers;

use App\Models\RecruitmentApply;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Illuminate\Http\Request;
class RecruitmentApplyController extends Controller
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
            $content->header('招聘申请');
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
            $content->header('招聘申请');
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
            $content->header('招聘申请');
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

        return Admin::grid(RecruitmentApply::class, function (Grid $grid) use ($request){
            $grid->disableExport();//禁止导出
            $grid->disableFilter();//禁止筛选
            $grid->disableCreateButton();//禁止创建按钮
            //默认排序
            $grid->model()->orderBy('created_at','DESC')->orderBy('id','DESC');
            $grid->id('ID')->sortable();
            $grid->ArticleTo()->title('岗位');
            $grid->column('name',"姓名");
            $grid->column('phone',"联系电话");
            $grid->ArticleTo()->title('应聘职位');
            $grid->column('created_at',"提交时间")->sortable();
            $grid->actions(function ($actions) {
                $row = $actions->row;
                if(!empty($row['resume_file'])){
                    $actions->prepend('<a href="/'.$row['resume_file'].'" target="_blank" ><i class="fa fa-arrow-down"></i></a>');
                }
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
        return Admin::form(RecruitmentApply::class, function (Form $form) use ($cate_id){
            $form->display('name', '姓名');
            $form->display('sex', '性别');
            $form->display('marriage', '婚姻');
            $form->display('email', '邮箱');
            $form->display('nation', '民族');
            $form->display('age', '年龄');
            $form->display('political_status', '政治面貌');
            $form->display('origin', '籍 贯');
            $form->display('education_level', '文化程度');
            $form->display('graduated_school', '毕业学校');
            $form->display('profession', '专业');
            $form->display('graduated_time', '毕业时间');
            $form->display('foreign_language_level', '外语水平');
            $form->display('position', '应聘职位');
            $form->display('phone', '联系电话');
            $form->display('resume', '个人简历');
            $form->display('created_at', '提交时间');
        });
    }
}
