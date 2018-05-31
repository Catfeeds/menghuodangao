<?php

namespace App\Admin\Controllers;

use App\Models\Config;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Illuminate\Http\Request;
class ConfigController extends Controller
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
            $content->description('站点信息');

            $content->body($this->form());
        });
        
    }
    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(Config::class, function (Form $form) {
            $form->tools(function (Form\Tools $tools) {
                // 去掉返回按钮
                $tools->disableBackButton();
                // 去掉跳转列表按钮
                $tools->disableListButton();
            });
            // $form->display('id', 'ID');
            $config = Config::orderBy('order',"ASC")->orderBy('id',"ASC")->get();
            foreach($config as $v){
                switch ($v['type']) {
                    case 'text':
                        $form->text("config_id[".$v['id']."]",trans('config.config_name.'.$v['name']))->value($v['value']);
                        break;
                    case 'textarea':
                        $form->textarea("config_id[".$v['id']."]",trans('config.config_name.'.$v['name']))->value($v['value']);
                        break;
                    case 'tags':
                        $form->tags("config_id[".$v['id']."]",trans('config.config_name.'.$v['name']))->value(explode(",",$v['value']));
                        break;
                    case 'img':
                        $form->image("config_id[".$v['id']."]",trans('config.config_name.'.$v['name']))->value($v['value']);
                        break;
                }
            }
            $form->setAction('/admin/config-save');
        });
    }

    public function config_save(Request $request){
        //系统配置保存
        $list = Config::get();

        foreach($list as $v){
            if($v['type']=='checkbox'){
                if($v['value']!=implode(",",$request['config_id'][$v['id']])){
                    Config::where("id",$v['id'])->update(['value'=>implode(",",$request['config_id'][$v['id']])]);
                }
            }elseif($v['type']=='img'){
                if(!empty($request['config_id'][$v['id']])){
                    $image = Image($request['config_id'][$v['id']],null,null,'uploads/config/');
                    Config::where("id",$v['id'])->update(['value'=>$image]);
                    @unlink($v['value']);
                }
            }elseif($v['type']=='tags'){
                if($v['value']!=implode(",",$request['config_id'][$v['id']])){
                    Config::where("id",$v['id'])->update(['value'=>implode(",",array_filter($request['config_id'][$v['id']]))]);
                }
            }else{
                if($v['value']!=$request['config_id'][$v['id']]){
                    Config::where("id",$v['id'])->update(['value'=>$request['config_id'][$v['id']]]);
                }
            }
        }
        \Cache::forget('ConfigGet');
        admin_toastr(trans('admin.update_succeeded'));
        return redirect('/admin/config');
    }
}
