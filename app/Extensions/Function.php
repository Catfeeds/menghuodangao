<?php
use App\Models\Config,App\Models\Nav,App\Models\AdsImage,App\Models\Link,App\Models\ArticleCategory,App\Models\Article,App\Models\AdsPosition;
/**
 * 站点信息获取
 * @param string $name [参数名称]
 */
function ConfigGet($name=''){
	//获取配置信息
	$list = [];
	if (\Cache::has('ConfigGet')) {
	    $list = \Cache::get('ConfigGet');
	}else{
	    $config_list = Config::get();
	    foreach ($config_list as $k => $v) {
	        $list[$v->name] = $v;
	    }
	    \Cache::forever('ConfigGet', $list);
	}
	if($name!='') {
	    return $list[$name]['value'];
	}else{
	    return $list;
	}
}

/**
 * 图片上传
 * @param [type] $file      [文件]
 * @param string $width     [压缩宽度]
 * @param string $height    [压缩高度]
 * @param string $save_path [存放路径]
 */
function Image($file,$width=null,$height=null,$save_path=""){
    if($file){
        
        $type=array("jpg","jpge","png","gif","JPG","JPEG","PNG","GIF");
        if(is_string($file)){
            $ext = explode(".",$file);
            $ext = $ext[count($ext)-1];
        }else{
            $ext = $file->getClientOriginalExtension();
        }
        if(empty($ext)){
            $mime = [
                'image/png'=>'png',
                'image/jpeg'=>'jpg',
                'image/gif'=>'gif',
            ];
            $ext = $mime[$file->getMimeType()];
        }
        // $ext = "jpg";
        if(!in_array($ext,$type)){
            return '';
        }
        if(empty($save_path)){
            $save_path = "uploads/images/".date("Ymd")."/";
        }
        // $save_path = $save_path.date("Ymd")."/";
        is_file($save_path) or @mkdir($save_path,0777,true);
        $file_name = uniqid('',true).".".$ext;
        if($width&&$height){
            $image = Image::make($file)->fit($width,$height)->save($save_path.$file_name);
        }elseif($width||$height){
            $image = Image::make($file)->resize($width,$height, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->save($save_path.$file_name);
        }else{
            $image = Image::make($file)->save($save_path.$file_name);
        }
        return $image->dirname."/".$image->basename;
    }
}
/**
 * 获取顶级id
 * @param  [type] $cate_info [分类id]
 * @param  [type] $mod       [模型]
 * @param  [type] $parent_id [上级id]
 */
function top_category($cate_info,$mod,$parent_id){
    if($cate_info[$parent_id]>0){
        $cate_info = $mod::where('id',$cate_info[$parent_id])->first();
        return top_category($cate_info,$mod,$parent_id);
    }else{
        return $cate_info;
    }
}


/**
 * json返回
 * @param  string  $message 提示
 * @param  integer $code    状态
 * @param  array   $data    数据
 * @return [type]           json
 */
function render($message = '',$code = 500,$data = array()){
    $return = array(
        'code' => $code,
        'data' => $data,
        'message'  => $message,
    );
    return response()->json($return);
}

/**
    * 分类树状化
    *@param   array     $list     分类数组
 */
function getTree($list,$id="id",$parent_id='parent_id') {
  $tree = array();
  if(is_array($list)) {
    $refer = array();
    foreach ($list as $key => $data) {
      $refer[$data[$id]] =&$list[$key];
    }
    foreach ($list as $key => $data) {
      $parentId = $data[$parent_id];
      if (0 == $parentId) {
        $tree[] =& $list[$key];
      }else{
        if (isset($refer[$parentId])) {
          $parent =& $refer[$parentId];
          $parent["child"][] =& $list[$key];
        }
      }
    }
  }
  return $tree;
}
/**
    * 分类select化
    * @param   array        $cat_id     分类数组
    * @param   int          $level      级别
 */
function optionsDate($list,$level=0,$id="id",$name="title"){
    $tree = array();
    foreach($list as $key=>$value){
        $tree[$value[$id]] = str_repeat('&nbsp;',$level*4).$value[$name];
        if(!empty($value['child'])){
            $tree += optionsDate($value['child'],$level+1,$id,$name);
        }
    }
    return $tree;
}
/**
 * 导航获取
 * @param  integer $type [description]
 * @return [type]        [description]
 */
function nav($type=0){
    //获取配置信息
    $nav_list = [];
    // if (\Cache::has('nav_'.$type)) {
    //     $nav_list = \Cache::get('nav_'.$type);
    // }else{
        $nav_list = Nav::where('type',$type)->orderBy('order',"ASC")->get()->toArray();
        
        if($nav_list){
            $nav_list = getTree($nav_list);
        }
    //     \Cache::forever('nav_'.$type, $nav_list);
    // }
    return $nav_list;
}
/**
 * 文件上传
 * @param  [type] $file      [文件]
 * @param  string $save_path [路径]
 * @return [type]            [description]
 */
function upload_file($file,$save_path=""){
    $ext = $file->getClientOriginalExtension();
    if(empty($save_path)){
        $save_path = "uploads/file/".date("Ymd")."/";
    }
    is_file($save_path) or @mkdir($save_path,0777,true);
    $file_name = uniqid('',true).".".$ext;
    $file->move($save_path,$file_name);
    return $save_path.$file_name;
}
/**
 * 获取广告图
 * @return [type] [description]
 */
function ads_image($cate_id=0,$take=false){
    if($take){
        return AdsImage::where('cate_id',$cate_id)->orderBy('order',"EDSC")->orderBy('id',"EDSC")->take($take)->get();
    }else{
        return AdsImage::where('cate_id',$cate_id)->orderBy('order',"EDSC")->orderBy('id',"EDSC")->get();
    }
}
/**
 * 获取广告图
 * @param  integer $cata_name [广告位名称]
 * @return [type]           [description]
 */
function ads_image_name($cata_name=''){
    $AdsPosition = AdsPosition::where('title',$cata_name)->first();
    return AdsImage::where('cate_id',$AdsPosition['id'])->orderBy('order',"EDSC")->orderBy('id',"EDSC")->get();
}
/**
 * 获取友情连接
 */
function link_get(){
    return Link::orderBy('order','DESC')->orderBy('id','DESC')->get();
}
/**
 * 获取分类信息
 * @return [type] [description]
 */
function cate_url($cate_id=0){
    return ArticleCategory::find($cate_id);
}
/**
 * 获取所有子分类id
 * @param  integer $cate_id [description]
 * @return [type]           [description]
 */
function sub_cate_in($cate_id=0){
    $sub_in = array($cate_id);
    $list = ArticleCategory::where("parent_id",$cate_id)->get();
    foreach($list as $k=>$v){
        $sub_in = array_merge($sub_in,sub_cate_in($v['id']));
    }
    return $sub_in;
}
/**
 * 生成网站地图
 * @return [type] [description]
 */
function sitemap(){
    $content='<?xml version="1.0" encoding="UTF-8"?>
    <urlset
        xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
        xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
           http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
    ';
    $data_array=array(
        array(
            'loc'=>env('APP_URL'),
            'priority'=>'1.0',
            'lastmod'=>date("Y-m-d H:i:s"),
            'changefreq'=>'always',
        ),
    );
    foreach($data_array as $data){
        $content.=create_item($data);
    }
    $cate_list = ArticleCategory::with(['ArticleMany'])->orderBy('id',"DESC")->get();
    foreach($cate_list as $v){
        $data = [
            'loc'=>URL('list-'.$v['id'].'-1.html'),
            'priority'=>'0.9',
            'lastmod'=>$v['updated_at'],
            'changefreq'=>'weekly',
        ];
        $content.=create_item($data);
        foreach($v['ArticleMany'] as $v2){
            $data = [
                'loc'=>URL('show-'.$v2['cate_id'].'-'.$v2['id'].'-1.html'),
                'priority'=>'0.9',
                'lastmod'=>$v2['updated_at'],
                'changefreq'=>'weekly',
            ];
            $content.=create_item($data);
        }
    }
    $content.='</urlset>';
    $fp=fopen('sitemap.xml','w+');
    fwrite($fp,$content);
    fclose($fp);
}
function create_item($data){
    $item="<url>\n";
    $item.="<loc>".$data['loc']."</loc>\n";
    $item.="<priority>".$data['priority']."</priority>\n";
    $item.="<lastmod>".$data['lastmod']."</lastmod>\n";
    $item.="<changefreq>".$data['changefreq']."</changefreq>\n";
    $item.="</url>\n";
    return $item;
}
/**
 * 百度主动推送
 * @param  [type] $url [推送的连接]
 * @return [type]       [description]
 */
function baidu_url($url){
    $api = 'http://data.zz.baidu.com/urls?site=ceshi.mhgjhb.com&token=ZS2wA7CWNHBjNdJi';
    $ch = curl_init();
    $options =  array(
        CURLOPT_URL => $api,
        CURLOPT_POST => true,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POSTFIELDS => $url,
        CURLOPT_HTTPHEADER => array('Content-Type: text/plain'),
    );
    curl_setopt_array($ch, $options);
    $result = curl_exec($ch);
    // echo $result;
}
/**
 * 判断是否为手机版
 * @return boolean [description]
 */
function isMobile() { 
  // 如果有HTTP_X_WAP_PROFILE则一定是移动设备
  if (isset($_SERVER['HTTP_X_WAP_PROFILE'])) {
    return true;
  } 
  // 如果via信息含有wap则一定是移动设备,部分服务商会屏蔽该信息
  if (isset($_SERVER['HTTP_VIA'])) { 
    // 找不到为flase,否则为true
    return stristr($_SERVER['HTTP_VIA'], "wap") ? true : false;
  } 
  // 脑残法，判断手机发送的客户端标志,兼容性有待提高。其中'MicroMessenger'是电脑微信
  if (isset($_SERVER['HTTP_USER_AGENT'])) {
    $clientkeywords = array('nokia','sony','ericsson','mot','samsung','htc','sgh','lg','sharp','sie-','philips','panasonic','alcatel','lenovo','iphone','ipod','blackberry','meizu','android','netfront','symbian','ucweb','windowsce','palm','operamini','operamobi','openwave','nexusone','cldc','midp','wap','mobile','MicroMessenger'); 
    // 从HTTP_USER_AGENT中查找手机浏览器的关键字
    if (preg_match("/(" . implode('|', $clientkeywords) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT']))) {
      return true;
    } 
  } 
  // 协议法，因为有可能不准确，放到最后判断
  if (isset ($_SERVER['HTTP_ACCEPT'])) { 
    // 如果只支持wml并且不支持html那一定是移动设备
    // 如果支持wml和html但是wml在html之前则是移动设备
    if ((strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') !== false) && (strpos($_SERVER['HTTP_ACCEPT'], 'text/html') === false || (strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') < strpos($_SERVER['HTTP_ACCEPT'], 'text/html')))) {
      return true;
    } 
  } 
  return false;
}