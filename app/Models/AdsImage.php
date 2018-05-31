<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Encore\Admin\Traits\AdminBuilder;
use Encore\Admin\Traits\ModelTree;
class AdsImage extends Model
{
	public $timestamps = false;
    protected $table = 'ads_image';
    public function AdsPositionTo(){
        return $this->belongsTo('App\Models\AdsPosition','cate_id','id');
    }
    static public function AdsImageList($attributes = array()){
    	$list = AdsImage::orderBy("order","DESC")->orderBy("id","DESC");
    	if(isset($attributes['cate_id'])&&trim($attributes['cate_id'])!=''){
    		$list = $list->where('cate_id',$attributes['cate_id']);
    	}
    	$paginate = isset($attributes['paginate'])?$attributes['paginate']:10;
    	if($paginate){
    		$list = $list->paginate($paginate);
    		$list->appends($attributes);
    	}else{
    		$list = $list->get();
    	}
    	return $list;
    }
}
