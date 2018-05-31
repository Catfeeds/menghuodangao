<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Encore\Admin\Traits\AdminBuilder;
use Encore\Admin\Traits\ModelTree;
use App\Models\ArticleCategory;
class Article extends Model
{
    protected $table = 'article';
    public function ArticleCategoryTo(){
        return $this->belongsTo('App\Models\ArticleCategory','cate_id','id');
    }
    public function CityTo(){
        return $this->belongsTo('App\Models\Region','city','region_id');
    }
    public function MoreImageMany(){
        return $this->hasMany('App\Models\MoreImage','more_id','id')->where('cate_id',1)->orderBy("order","DESC")->orderBy("id","DESC");
    }
    static public function ArticleSave($attributes=array()){

		$caregory_info = ArticleCategory::find($attributes['cate_id']);
		
        if($attributes['id']>0){
        	$info = Article::find($attributes['id']);
        }
        if(!isset($info)||!$info){
        	$info = new Article;
        }
        if(isset($attributes['title'])){
        	$info->title = $attributes['title'];
        }
        if(isset($attributes['content'])){
        	$info->content = $attributes['content'];
        }
        if(isset($attributes['desc'])){
        	$info->desc = $attributes['desc'];
        }
        if(isset($attributes['seo_title'])){
        	$info->seo_title = $attributes['seo_title'];
        }
        if(isset($attributes['seo_keywords'])){
        	$info->seo_keywords = $attributes['seo_keywords'];
        }
        if(isset($attributes['seo_description'])){
        	$info->seo_description = $attributes['seo_description'];
        }
    	if(isset($attributes['img'])&&!empty($attributes['img'])){
    		//图片尺寸处理
    		$width = trans('template.template_width.'.$caregory_info['template']);
    		$height = trans('template.template_height.'.$caregory_info['template']);
    		$image = Image($attributes['img'],$width,$height,"uploads/article/".date("Ymd")."/");
    		if(isset($info->img)&&!empty($info->img)){
    			@unlink($info->img);
    		}
    		$info->img = $image;
    	}
    	
        if(isset($attributes['click'])){
        	$info->click = $attributes['click'];
        }
        if(isset($attributes['cate_id'])){
        	$info->cate_id = $attributes['cate_id'];
        }
        if(isset($attributes['is_top'])){
        	$info->is_top = $attributes['is_top'];
        }
        if(isset($attributes['editor'])){
        	$info->editor = $attributes['editor'];
        }
        if(isset($attributes['add_time'])&&!empty($attributes['add_time'])){
        	$info->add_time = $attributes['add_time'];
        }
        if(!isset($info->add_time)||empty($info->add_time)){
        	$info->add_time = date("Y-m-d H:i:s");
        }
        $info->save();
    	return $info;
    }


    static public function ArticleList($attributes = array()){
        $list = Article::with(['ArticleCategoryTo','CityTo','MoreImageMany']);
        if(isset($attributes['cate_id'])&&trim($attributes['cate_id'])!=''){
            $list = $list->where('cate_id',$attributes['cate_id']);
        }
        if(isset($attributes['cate_id_in'])&&count($attributes['cate_id_in'])){
            $list = $list->whereIn('cate_id',$attributes['cate_id_in']);
        }
        if(isset($attributes['province'])&&trim($attributes['province'])!=''){
            $list = $list->where('province',$attributes['province']);
        }
        if(isset($attributes['city'])&&trim($attributes['city'])!=''){
            $list = $list->where('city',$attributes['city']);
        }
        if(isset($attributes['order'])&&trim($attributes['order'])!=''){
            $list = $list->orderBy($attributes['order'],$attributes['sort']);
        }
        $list = $list->orderBy("add_time","DESC")->orderBy("id","DESC");
        if(isset($attributes['take'])&&trim($attributes['take'])!=''){
            $list = $list->take($attributes['take'])->get();
        }else{
            $paginate = isset($attributes['paginate'])?$attributes['paginate']:10;
            if($paginate){
                $list = $list->paginate($paginate);
                $list->appends($attributes);
            }else{
                $list = $list->get();
            }
        }
        return $list;
    }

}
