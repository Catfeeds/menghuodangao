<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Encore\Admin\Traits\AdminBuilder;
use Encore\Admin\Traits\ModelTree;

class ArticleCategory extends Model
{
	use ModelTree, AdminBuilder;
    protected $table = 'article_category';
    public function ArticleMany(){
        return $this->hasMany('App\Models\Article','cate_id','id')->orderBy("add_time","DESC")->orderBy("id","DESC");
    }
    public function MoreImageMany(){
        return $this->hasMany('App\Models\MoreImage','more_id','id')->where('cate_id',2)->orderBy("order","DESC")->orderBy("id","DESC");
    }
}
