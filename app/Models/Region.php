<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $table = 'region';

    public $timestamps = false;

    public function scopeProvince()
    {
        return $this->where('region_type', 1);
    }
    
    public function scopeCity()
    {
        return $this->where('region_type', 2);
    }

    public function scopeDistrict()
    {
        return $this->where('region_type', 3);
    }

    public function parent()
    {
        return $this->belongsTo(Region::class, 'region_parent_id','region_id');
    }

    public function children()
    {
        return $this->hasMany(Region::class, 'region_parent_id','region_id');
    }

    public function brothers()
    {
        return $this->parent->children();
    }
    static public function regionList($attributes=array()){
        $list = new Region;
        if(isset($attributes['region_type'])&&trim($attributes['region_type'])!=''){
            $list = $list->where('region_type',$attributes['region_type']);
        }
        $list = $list->orderBy("id","DESC");
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
    public static function options($region_id)
    {

        if (! $self = static::where('region_id',$region_id)->first()) {
            return [];
        }

        return $self->brothers()->pluck('region_name', 'region_id');
    }
}
