<?php

namespace App\Admin\Controllers;

use App\Models\User;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Illuminate\Validation\Rule;

class UserController extends Controller
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

            $content->header('会员');
            $content->description('会员');

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

            $content->header('header');
            $content->description('description');

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

            $content->header('header');
            $content->description('description');

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
        return Admin::grid(User::class, function (Grid $grid) {

            $grid->id('ID')->sortable();
            $grid->id('ID')->sortable();

            $grid->created_at();
            $grid->updated_at();
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {

        return Admin::form(User::class, function (Form $form) {
            $form->text('name', '名称')->rules('required');
            $form->text('email', '邮箱')->rules(function ($form) {
                // 如果不是编辑状态，则添加字段唯一验证
                return [
                    'required',
                    'email',
                    Rule::unique('users')->ignore($form->model()->id),
                ];
            });
            $form->password('password', '密码')->rules(function ($form) {
                // 如果不是编辑状态，则添加字段唯一验证
                if (!$id = $form->model()->id) {
                    return 'required|min:6';
                }
            });

            $form->display('id', 'ID');
            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');

            $form->saving(function($arr){
                // admin_toastr('laravel-admin 提示','success');
                $password = $arr->password;
                if(isset($password)&&!empty($password)){
                    $arr->password = bcrypt($password);
                }
            });
        });
    }
}
