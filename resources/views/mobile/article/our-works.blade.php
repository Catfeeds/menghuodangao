@extends('home.layouts.app')
@section('style')
    @parent
@endsection
@section('content')
<div class="main">
    <div class="wrap">
        <div class="clearfix">
            <div class="main_l">
                @include('home.layouts.location')
            </div>
            <div class="main_r">
                @include('home.layouts.top_banner')
            </div>
        </div>
        <div class="our_list">
            <ul class="clearfix">
                @foreach($article_list as $k=>$v)
                <li>
                    <a>
                        <img src="{{asset($v['img'])}}" alt="{{$v['title']}}">
                        <h5 title="{{$v['title']}}">{{$v['title']}}</h5>
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
        @include('home.layouts.page',['page'=>$article_list])
    </div>
</div>
<div class="img_slick">
    <i class="iconfont icon-butongguodechacha"></i>
    <div class="img_box">
        @foreach($article_list as $k=>$v)
        <div class="slick_box clearfix">
            <div class="img">
                <img src="{{asset($v['img'])}}" alt="{{$v['title']}}" >
            </div>
            <div class="text">
                <h4 title="{{$v['title']}}">{{$v['title']}}</h4>
                <p title="{!!nl2br($v['desc'])!!}">{!!nl2br($v['desc'])!!}</p>
            </div>
        </div>
        @endforeach
    </div>
</div>
<div class="img_bg"></div>
@endsection
@section('script')
    @parent
    <script type="text/javascript">

        $('.img_box').slick();
        $(".img_slick .icon-butongguodechacha").click(function(){
            $(".img_slick,.img_bg").fadeOut();
        })
        $(".img_bg").click(function(){
            $(".img_slick,.img_bg").fadeOut();
        })
        $(".our_list li").click(function(){
            var eq = $(this).index();
            $(".img_slick,.img_bg").fadeIn();
            $('.img_box').slick("slickGoTo",eq);
        })
        img_box_height();
        $(window).resize(function(){
            img_box_height();
        })
        function img_box_height(){
            if($("body").width()<1024){
                $(".img_slick .slick-list").css("max-height",$(window).height());
            }else{
                $(".img_slick .slick-list").css("max-height",$(window).height()*0.9);
            }
        }
        setTimeout(function(){
            $(".img_slick").hide();
            $(".img_slick").css("opacity",1);
        },300)
        
        
    </script>
@endsection