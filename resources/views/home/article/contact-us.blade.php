@extends('home.layouts.app')
@section('style')
    @parent
    <style type="text/css">
        .map{margin-bottom: 35px;position:relative;height: 500px;}
        .map img{width: auto;height: auto;}

    </style>
@endsection
@section('content')
@include('home.layouts.banner')
<div class="main">
    <div class="contact">
        <div class="con">
            {!!$cate_info['content']!!}
        </div>
        <div class="map" id="allmap">
            
        </div>
    </div>
    @include('home.layouts.hot')
</div>
@endsection
@section('script')
    @parent
    <script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=c2AOMaFjyxR1itkA2z1yWOKysUgdjE6I"></script>
    <script type="text/javascript">
        // 百度地图API功能
        var map = new BMap.Map("allmap");
        var point = new BMap.Point(113.439496,23.107027);
        var marker = new BMap.Marker(point);  // 创建标注

        map.addOverlay(marker);              // 将标注添加到地图中
        map.centerAndZoom(point,16);
        map.enableScrollWheelZoom(true);
        var opts = {
          title : "" , // 信息窗口标题
          enableMessage:true,//设置允许信息窗发送短息
          // message:"亲耐滴，晚上一起吃个饭吧？戳下面的链接看下地址喔~"
        }
        var infoWindow = new BMap.InfoWindow("广州市萌货信息科技有限公司", opts);  // 创建信息窗口对象 
        marker.addEventListener("click", function(){          
            map.openInfoWindow(infoWindow,point); //开启信息窗口
        });
    </script>
@endsection