<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article,App\Models\ArticleCategory;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        
        parent::__construct();
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        // sitemap();
        if(isMobile()){
            $banner = ads_image(22);
            $index_1 = ArticleCategory::orderBy('order',"ASC")->where('parent_id',6)->get();//获取一级分类

            $index_2 = Article::ArticleList([
                'cate_id_in'=>sub_cate_in(8),
                'order'=>'is_top',
                'sort'=>'DESC',
                'paginate'=>4,
            ]);
            $index_6 =  Article::ArticleList([
                'cate_id'=>319,
                'order'=>'is_top',
                'sort'=>'DESC',
                'paginate'=>4,
            ]);
            $index_6_cate = ArticleCategory::find(317);

            $index_8 = ArticleCategory::orderBy('order',"ASC")->whereIn('id',[27,42,320])->get();//获取一级分类
            foreach($index_8 as $k=>$v){
                $v['article'] = Article::ArticleList([
                    'cate_id'=>$v['id'],
                    'order'=>'is_top',
                    'sort'=>'DESC',
                    'paginate'=>10,
                ]);
            }

            //获取所有课程
            $course =Article::ArticleList([
                'cate_id_in'=>sub_cate_in(6),
                'paginate'=>0,
            ]);
            $course_menu = ArticleCategory::orderBy('order',"ASC")->where('parent_id',6)->get();//获取一级分类
            foreach($course_menu as $k=>$v){
                $v['article'] = Article::ArticleList([
                    'cate_id'=>$v['id'],
                    'order'=>'is_top',
                    'sort'=>'DESC',
                    'paginate'=>0,
                ]);
            }
            $assign = [
                'course'         => $course,
                'banner'         => $banner,
                'index_1'        => $index_1,
                'index_2'        => $index_2,
                'index_6'        => $index_6,
                'index_6_cate'   => $index_6_cate,
                'index_8'        => $index_8,
                'course_menu'    => $course_menu,
                'is_course_menu' => 1,
                'is_index'       => 1,
            ];
        }else{
            $banner = ads_image(12);
            $index_1 = ArticleCategory::orderBy('order',"ASC")->where('parent_id',6)->take(4)->get();//获取一级分类
            foreach($index_1 as $k=>$v){
                $v['article'] = Article::ArticleList([
                    'cate_id'=>$v['id'],
                    'order'=>'is_top',
                    'sort'=>'DESC',
                    'paginate'=>7,
                ]);
            }
            $index_1_cate = ArticleCategory::find(6);

            $index_2 = ArticleCategory::orderBy('order',"ASC")->where('parent_id',8)->get();//获取一级分类
            foreach($index_2 as $k=>$v){
                $v['article'] = Article::ArticleList([
                    'cate_id'=>$v['id'],
                    'order'=>'is_top',
                    'sort'=>'DESC',
                    'paginate'=>9,
                ]);
            }
            $index_2_cate = ArticleCategory::find(8);

            $index_3 = Article::ArticleList([
                'cate_id'=>63,
                'order'=>'is_top',
                'sort'=>'DESC',
                'take'=>18,
            ]);
            $index_3_cate = ArticleCategory::find(63);

            $index_4 = Article::ArticleList([
                'cate_id'=>22,
                'order'=>'is_top',
                'sort'=>'DESC',
                'take'=>9,
            ]);
            $index_4_cate = ArticleCategory::find(22);


            $index_5_cate = ArticleCategory::find(64);
            $index_6_cate = ArticleCategory::find(65);
            $index_6 = Article::ArticleList([
                'cate_id'=>65,
                'order'=>'is_top',
                'sort'=>'DESC',
                'take'=>6,
            ]);

            $index_7 = Article::ArticleList([
                'cate_id'=>7,
                'order'=>'is_top',
                'sort'=>'DESC',
                'take'=>9,
            ]);
            $index_7_cate = ArticleCategory::find(7);

            $index_8 = Article::ArticleList([
                'cate_id'=>27,
                'order'=>'is_top',
                'sort'=>'DESC',
                'take'=>9,
            ]);
            $index_8_cate = ArticleCategory::find(27);
            $index_9 = Article::ArticleList([
                'cate_id'=>42,
                'order'=>'is_top',
                'sort'=>'DESC',
                'take'=>9,
            ]);
            $index_9_cate = ArticleCategory::find(42);

            $assign = [
                'banner'       => $banner,
                'index_1'      => $index_1,
                'index_1_cate' => $index_1_cate,
                'index_2'      => $index_2,
                'index_2_cate' => $index_2_cate,
                'index_3'      => $index_3,
                'index_3_cate' => $index_3_cate,
                'index_4'      => $index_4,
                'index_4_cate' => $index_4_cate,
                'index_5_cate' => $index_5_cate,
                'index_6_cate' => $index_6_cate,
                'index_6' => $index_6,
                'index_7'      => $index_7,
                'index_7_cate' => $index_7_cate,
                'index_8'      => $index_8,
                'index_8_cate' => $index_8_cate,
                'index_9'      => $index_9,
                'index_9_cate' => $index_9_cate,
                'url'          => [
                    0=>'',
                ],
            ];
        }
        
        if(isMobile()){
            return view('mobile.home',$assign);
        }else{
            return view('home.home',$assign);
        }
    }
}
