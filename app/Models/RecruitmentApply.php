<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Encore\Admin\Traits\AdminBuilder;
use Encore\Admin\Traits\ModelTree;
use App\Models\ArticleCategory;
class RecruitmentApply extends Model
{
    protected $table = 'recruitment_apply';
    public function ArticleTo(){
        return $this->belongsTo('App\Models\Article','article_id','id');
    }
    static public function RecruitmentApplySave($attributes=array()){

        if($attributes['id']>0){
        	$info = RecruitmentApply::find($attributes['id']);
        }
        if(!isset($info)||!$info){
        	$info = new RecruitmentApply;
        }
        if(isset($attributes['article_id'])){
            $info->article_id = $attributes['article_id'];
        }
        if(isset($attributes['name'])){
            $info->name = $attributes['name'];
        }
        if(isset($attributes['sex'])){
            $info->sex = $attributes['sex'];
        }
        if(isset($attributes['marriage'])){
            $info->marriage = $attributes['marriage'];
        }
        if(isset($attributes['email'])){
            $info->email = $attributes['email'];
        }
        if(isset($attributes['nation'])){
            $info->nation = $attributes['nation'];
        }
        if(isset($attributes['age'])){
        	$info->age = $attributes['age'];
        }
        if(isset($attributes['political_status'])){
        	$info->political_status = $attributes['political_status'];
        }
        if(isset($attributes['origin'])){
        	$info->origin = $attributes['origin'];
        }
        if(isset($attributes['education_level'])){
        	$info->education_level = $attributes['education_level'];
        }
        if(isset($attributes['graduated_school'])){
        	$info->graduated_school = $attributes['graduated_school'];
        }
        if(isset($attributes['profession'])){
            $info->profession = $attributes['profession'];
        }
        if(isset($attributes['graduated_time'])){
            $info->graduated_time = $attributes['graduated_time'];
        }
        if(isset($attributes['foreign_language_level'])){
            $info->foreign_language_level = $attributes['foreign_language_level'];
        }
        if(isset($attributes['position'])){
            $info->position = $attributes['position'];
        }
        if(isset($attributes['phone'])){
            $info->phone = $attributes['phone'];
        }
        if(isset($attributes['resume_file'])){
            $info->resume_file = $attributes['resume_file'];
        }
        if(isset($attributes['resume'])){
        	$info->resume = $attributes['resume'];
        }
        $info->save();
    	return $info;
    }

}
