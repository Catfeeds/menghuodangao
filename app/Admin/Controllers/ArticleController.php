<?php

namespace App\Admin\Controllers;

use App\Models\ArticleCategory,App\Models\Article,App\Models\Region;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Illuminate\Http\Request;
class ArticleController extends Controller
{
    use ModelForm;

    public function iframe(){
    	return Admin::content(function (Content $content) use ($request){
    	    // $content->header('文章');
    	    // $content->description('文章');
    	    $ArticleCategory = ArticleCategory::orderBy("order","ASC")->get()->toArray();
	        foreach($ArticleCategory as $k=>&$v){
	          $v['target'] = "box-container";
	          $v['url'] = URL('admin/article')."?no_header=true&no_sidebar=true&no_footer=true&cate_id=".$v['id'];
	        }
    	    $assign = [
    	    	'ArticleCategory'=>json_encode($ArticleCategory,JSON_UNESCAPED_UNICODE),
    	    ];
    	    $content->body(view('admin.article',$assign));
    	});

    }
    /**
     * Index interface.
     *
     * @return Content
     */
    public function index(Request $request)
    {
       
        return Admin::content(function (Content $content) use ($request){

            $content->header('文章');
            $content->description('文章');

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
            $content->header('文章');
            $content->description('文章');
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

            $content->header('文章');
            $content->description('文章');

            $content->body($this->form($request));
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid($request='')
    {
        return Admin::grid(Article::class, function (Grid $grid) use ($request){
            $grid->disableExport();
            $grid->paginate(15);
            //默认排序
            $grid->model()->orderBy('is_top','DESC')->orderBy('sort_order','DESC')->orderBy('add_time','DESC');

            $grid->id('ID')->sortable();
            $grid->column('title',"标题");
            
            $grid->ArticleCategoryTo()->title('分类');
            // $grid->img("图片")->image();
            $states = [
                'on'  => ['value' => 1, 'text' => '是', 'color' => 'success'],
                'off' => ['value' => 0, 'text' => '否', 'color' => 'danger'],
            ];
            $grid->is_top('推荐')->switch($states);
            $grid->add_time('创建日期')->sortable();
            $grid->sort_order('排序值')->sortable();

            
            $grid->actions(function ($actions) {
                $row = $actions->row;
                $actions->prepend('<a href="/admin/more-image?cate_id=1&more_id='.$row['id'].'"><i class="fa fa-image"></i></a>');
            });
            if($request['cate_id']>0){
                $grid->urlCreateButton('/admin/article/create?cate_id='.$request['cate_id']);//修改添加按钮链接
            }
            //筛选
            $grid->filter(function ($filter) {
                $filter->like('title','标题');
                $filter->equal('cate_id','分类')->select(ArticleCategory::selectOptions(['top'=>false]));
                $filter->equal('is_top','推荐')->radio([
                    ''   => '全部',
                    0    => '否',
                    1    => '是',
                ]);
            });

            // $grid->created_at();
            // $grid->updated_at();
            
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form($request='')
    {
        return Admin::form(Article::class, function (Form $form) use ($request){

        	$form->tools(function (Form\Tools $tools) {
        	    // 去掉跳转列表按钮
        	    $tools->disableListButton();
        	});
        	
            $form->hidden('id','ID');
            $form->text('title','标题')->rules('required');
            $form->text('en_title','英文标题');
            $form->text('title2','副标题');

            $cate = ArticleCategory::orderBy('order',"ASC")->get()->toarray();
            foreach($cate as &$v){
                $width = trans('template.template_width.'.$v['template'])>0?trans('template.template_width.'.$v['template']):0;
                $height = trans('template.template_height.'.$v['template'])>0?trans('template.template_height.'.$v['template']):0;
                $v['title'] .= "(".$width."*".$height.")";
            }
            $cate_options = optionsDate(getTree($cate));

            $form->select('cate_id','所属分类')->options($cate_options)->rules('required')->default($request['cate_id']);
            $form->textarea('desc','描述')->rows(3);
            $form->textarea('desc2','描述2')->rows(3);
            $form->editor('content','内容');
            $form->image('img','图片')->move('/uploads/article/'.date('Ymd'))->uniqueName();
            $form->text('alt','图片alt');
            $form->image('img2','图片2')->move('/uploads/article/'.date('Ymd'))->uniqueName();
            $form->text('alt2','图片2alt');
            // $form->number('click','访问量');
            $form->text('editor','来源')->default('萌货国际烘焙');
            $states = [
                'on'  => ['value' => 1, 'text' => '是', 'color' => 'success'],
                'off' => ['value' => 0, 'text' => '否', 'color' => 'danger'],
            ];
            $form->switch('is_top','推荐')->states($states);
            $form->number('sort_order', '排序值')->default('50');
            $form->datetime('add_time','创建日期')->format('YYYY-MM-DD HH:mm:ss')->default(date('Y-m-d H:i:s'));
            $form->text('seo_title', 'seo title');
            $form->text('seo_keywords', 'seo keywords');
            $form->text('seo_description', 'seo description');
            // $form->text('job_title', '职称');
            $form->text('video', '视频链接');
            $form->text('tag','标签');
            $form->text('day','天数');

            // $form->html('', $label = '知识解答');
            // $form->divide();
            // $form->textarea('problem', '问题');
            // $form->textarea('reply', '回答');

            // $form->html('', $label = '招贤纳士');
            // $form->divide();
            // $form->text('work_place', '工作地点');
            // $form->text('department', '部门');
            // $form->text('working_years', '工作年限');
            // $form->text('education', '学历');
            // $form->text('recruitment_number', '招聘人数');

            // $form->html('', $label = '校区');
            // $form->divide();
            // $form->text('address', '地址');
            // $form->text('phone', '电话');
            // $form->text('trade_date', '营业日期');
            // $form->text('trade_time', '营业时间');

            // $form->select('province','省份')->options(
            //     Region::province()->pluck('region_name','region_id')
            // )->load('city', '/admin/city');
            // $form->select('city','城市')->options(function ($region_id) {
            //     return Region::options($region_id);
            // });


            $form->saving(function (Form $form) {
                $caregory_info = ArticleCategory::find($form->cate_id);
                $width = trans('template.template_width.'.$caregory_info['template']);
                $height = trans('template.template_height.'.$caregory_info['template']);
                if($width>0||$height>0){
                    $form->img = Image($form->img,$width,$height,"uploads/article/".date("Ymd")."/");
                }
            });
            $form->saved(function (Form $form) {
                //链接推送
                baidu_url(env('APP_URL').'/show-'.$form->cate_id.'-'.$form->id.'-1.html');
                sitemap();//网站地图
            });
            // $form->setAction('/admin/article-save');//提交地址

            // 设置日期格式，更多格式参考http://momentjs.com/docs/#/displaying/format/
            // $form->display('updated_at', '更新日期');
        });
    }

    // public function article_save(Request $request){
    //     $this->validate($request,[
    //         'title' => 'required',
    //         'cate_id' => 'required',
    //     ],[],[
    //         'title'=>'标题',
    //         'cate_id'=>'所属分类',
    //     ]);
    //     //文章保存
    //     Article::ArticleSave($request->all());
    //     admin_toastr(trans('admin.update_succeeded'));
    //     return redirect('/admin/article');
    // }
}
