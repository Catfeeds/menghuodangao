<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Encore\Admin\Traits\AdminBuilder;
use Encore\Admin\Traits\ModelTree;
class AdsPosition extends Model
{
    public $timestamps = false;
    protected $table = 'ads_position';
    public function AdsImageMany(){
        return $this->hasMany('App\Models\AdsImage','cate_id','id')->orderBy("order","DESC")->orderBy("id","DESC");
    }
    
}
