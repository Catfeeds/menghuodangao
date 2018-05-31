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
                <div class="province">
                    <form method="get">
                        <select name="province" id="province" class="select">
                            <option value="">选择省份地区</option>
                            @foreach($province as $v)
                            <option value="{{$v['region_id']}}" @if(request()->province==$v['region_id']) selected="selected" @endif>{{$v['region_name']}}</option>
                            @endforeach
                        </select>
                    </form>
                </div>
                @include('home.layouts.main_l_lx')
                @include('home.layouts.main_l_bm')
            </div>
            <div class="main_r">
                @include('home.layouts.top_banner')
                <div class="campus_list">
                    <ul class="clearfix">
                        @foreach($article_list as $k=>$v)
                        <li>
                            <h5>{{$v['CityTo']['region_name'] or ''}}</h5>
                            <p title="{{$v['title']}}">{{$v['title']}}</p>
                            <p class="address" title="{{$v['address']}}">{{$v['address']}}</p>
                            <p title="{{$v['phone']}}">{{$v['phone']}}</p>
                            <a class="more">查看地图 —></a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="img2_slick">
    <i class="iconfont icon-butongguodechacha"></i>
    <div class="img_box">
        @foreach($article_list as $k=>$v)
        <div class="slick_box clearfix">
            <div class="img_si">
                @if(isset($v['MoreImageMany']))
                @foreach($v['MoreImageMany'] as $img_v)
                <div class="rsContent"><img src="{{asset($img_v['image'])}}" alt="{{$img_v['alt']}}" ></div>
                @endforeach
                @else
                <div class="rsContent"></div>
                @endif
            </div>
            <div class="text">
                <h5>{{$v['CityTo']['region_name'] or ''}}</h5>
                <h5 title="{{$v['title']}}">{{$v['title']}}</h5>
                <p class="img2_title">地址：</p>
                <p title="{{$v['address']}}">{{$v['address']}}</p>
                <p>{{$v['phone']}}</p>
                <a class="more">查看地图 —></a>
                <p class="img2_title">营业时间：</p>
                <p class="date">{{$v['trade_date']}}<span>{{$v['trade_time']}}</span></p>
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
        $("#province").change(function(){
            $(this).parents("form").submit();
        })
        $('.img_box').slick({
            'draggable':false,
            'touchMove':false,
            'swipe':false,
        });
        $('.img_si').royalSlider({
            arrowsNav: true,
            loop: false,
            keyboardNavEnabled: true,
            controlsInside: false,
            imageScaleMode: 'fill',
            arrowsNavAutoHide: false,
            autoScaleSlider: true, 
            // autoScaleSliderWidth: 736,     
            // autoScaleSliderHeight: 596,
            controlNavigation: 'bullets',
            thumbsFitInViewport: false,
            navigateByClick: true,
            startSlideId: 0,
            autoPlay: false,
            transitionType:'move',
            globalCaption: true,
            deeplinking: {
                enabled: true,
                change: false
            },
            // imgWidth: 736,
            // imgHeight: 596
        });
        setTimeout(function(){
            img_si_height();
            $(".img2_slick").hide();
            $(".img2_slick").css("opacity",1);
        },300)
        
        function img_si_height(){
            $(".img_si").each(function(){
                var height = 0;
                $(this).find("img").each(function(){
                    var img = new Image();
                    img.src = $(this).attr("src");
                    img_height = $(this).parents('.img_si').width()/img.width*img.height;
                    if(img_height>height){
                        height = img_height;
                    }
                })
                $(this).find('.rsOverflow').height(height);
                $(this).height(height);
            })
        }
        $(".img2_slick .icon-butongguodechacha").click(function(){
            $(".img2_slick,.img_bg").fadeOut();
        })
        $(".img_bg").click(function(){
            $(".img2_slick,.img_bg").fadeOut();
        })
        $(".campus_list li").click(function(){
            var eq = $(this).index();
            $(".img2_slick,.img_bg").show();
            $('.img_box').slick("slickGoTo",eq);
        })
        img_box_height();
        $(window).resize(function(){
            img_box_height();
            img_si_height()
        })
        function img_box_height(){
            if($("body").width()<1024){
                $(".img2_slick .slick-list").css("max-height",$(window).height());
            }else{
                $(".img2_slick .slick-list").css("max-height",$(window).height()*0.9);
            }
        }
    </script>
@endsection