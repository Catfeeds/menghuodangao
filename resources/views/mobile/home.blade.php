@extends('mobile.layouts.app')
@section('style')
    @parent
@endsection
@section('content')
@include('mobile.layouts.banner')
    <div class="tout clearfix">
        <span class="fl">头条:</span>
        <div class="fr">
            <div class="swiper-container mes">
                <div class="swiper-wrapper">
                    @foreach(nav(3) as $k=>$v)
                    <div class="swiper-slide">
                        <div class="gd"><a @if(!empty($v['url']))href="{{$v['url']}}"@endif @if($v['is_blank']) target="_blank" @endif title="{{$v['title']}}" >{{$v['title']}}</a><em></em></div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="index_1">
        <div class="title">推荐课程<p>Recommend course</p></div>
        <ul>
            @foreach($index_1 as $i1)
            <li class="clearfix">
                <div class="pic"><img src="{{asset($i1['img2'])}}" alt="{{$i1['alt']}}"></div>
                <div class="w">
                    <p><em>{{$i1['en_title']}}</em>{{$i1['title']}}</p>
                    <a href="{{URL('list-6-1.html')}}">课程详情</a>
                </div>
            </li>
            @endforeach
        </ul>
        <div class="twobtn clearfix">
            <a href="tel:{{ConfigGet('tel_phone')}}"><span>{{ConfigGet('tel_phone')}}</span></a>
            <a href="{{ConfigGet('kefu_53')}}" target="_blank"><span>向我推荐适合课程</span></a>
        </div>
    </div>
    <div class="index_2">
        <div class="title">实力保障<p>STRENGTH GUARANTEE</p></div>
        <dl class="clearfix">
            @foreach(ads_image(23) as $k=>$v)
            <dd><a @if(!empty($v['url']))href="{{$v['url']}}"@endif title="{{$v['title']}}" target="_blank" ><img src="{{asset($v['image'])}}" alt="{{$v['alt']}}"></a></dd>
            @endforeach
        </dl>
    </div>
    <div class="index_3">
        <div class="title">学员风采<p>STUDENTS DEMEANOR</p></div>
        <div class="pic index3_pic">
            <div class="swiper-wrapper">
                @foreach(ads_image(24) as $v)
                <div class="swiper-slide"><a @if(!empty($v['url']))href="{{$v['url']}}"@endif target="_blank"><img src="{{asset($v['image'])}}" alt="{{$v['alt']}}"></a></div>
                @endforeach
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
    <div class="index_4">
        <div class="title">{{$index_2_cate['title']}}<p>{{$index_2_cate['en_title']}}</p></div>
        <ul class="clearfix">
            @foreach($index_2 as $i2)
                <li>
                    <a>
                        <div class="pic"><img src="{{asset($i2['img'])}}" alt="{{$i2['alt']}}"></div>
                        <p>{{$i2['title']}}</p>
                    </a>
                </li>
            @endforeach
        </ul>
        <div class="twobtn clearfix">
            <a href="tel:{{ConfigGet('tel_phone')}}"><span>{{ConfigGet('tel_phone')}}</span></a>
            <a href="{{URL('list-8-1.html')}}">点击查看更多作品</a>
        </div>
    </div>
    <div class="index_5">
        @foreach(ads_image(25,1) as $v)
        <a @if(!empty($v['url']))href="{{$v['url']}}"@endif target="_blank"><img src="{{asset($v['image'])}}" alt="{{$v['alt']}}"></a>
        @endforeach
    </div>
    <div class="index_6">
        <div class="title">{{$index_6_cate['title']}}<p>{{$index_6_cate['en_title']}}</p></div>
        <ul class="clearfix">
            @foreach($index_6 as $i6)
                <li>
                    <a href="{{URL('show-'.$i6['cate_id'].'-'.$i6['id'].'-1.html')}}">
                        <div class="pic"><img src="{{asset($i6['img'])}}" alt="{{$i6['alt']}}"></div>
                        <h3>{{$i6['title']}}</h3>
                        <p>{!!nl2br($i6['desc'])!!}</p>
                        <p>{!!nl2br($i6['desc2'])!!}</p>
                    </a>
                </li>
            @endforeach
        </ul>
        <div class="twobtn clearfix">
            <a href="tel:{{ConfigGet('tel_phone')}}"><span>{{ConfigGet('tel_phone')}}</span></a>
            <a href="{{URL('list-317-1.html')}}">点击查看更多作品</a>
        </div>
    </div>
    <div class="index_7">
        <ul class="tit clearfix">
            @foreach($index_8 as $k8=>$i8)
            <li @if($k8==0) class="on" @endif>{{$i8['title']}}</li>
            @endforeach
        </ul>
        <div class="swiper-container dongt">
            <div class="swiper-wrapper">
            @foreach($index_8 as $k8=>$i8)
                <div class="swiper-slide">
                    <ul>
                        @foreach($i8['article'] as $k=>$v)
                        <li><a href="{{URL('show-'.$v['cate_id'].'-'.$v['id'].'-1.html')}}">@if(!empty($v['tag']))<p @if($v['tag']=='头条') class="p1" @endif>{{$v['tag']}}</p>@endif<span>{{$v['title']}}</span><i>{{$v['click']}}</i></a></li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
            </div>
        </div>
    </div>
    <div class="index_5">
        @foreach(ads_image(26,1) as $v)
        <a @if(!empty($v['url']))href="{{$v['url']}}"@endif target="_blank"><img src="{{asset($v['image'])}}" alt="{{$v['alt']}}"></a>
        @endforeach
    </div>
    <div class="index_9">
        <div class="con">
            <div class="tit">极速在线报名</div>
            <form method="POST" action="{{URL('apply-save')}}">
                {{ csrf_field() }}
                <div class="int clearfix">
                    <span>学员姓名：</span>
                    <input type="text" name="name" class="text" />
                </div>
                <div class="int clearfix">
                    <span>联系电话：</span>
                    <input type="text" name="phone" class="text" />
                </div>
                <div class="int clearfix">
                    <span>报名课程：</span>
                    <select name="course_id">
                        <option value="">请选择要报名的课程</option>
                        @foreach($course as $v)
                        <option value="{{$v['id']}}">{{$v['title']}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="btn clearfix">
                    <a href="{{ConfigGet('kefu_53')}}" target="_blank"><em>点击在线咨询</em></a>
                    <div class="but"><input type="button" class="button" id="apply_submit"><em>提交报名</em></div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('script')
    @parent
    <script>
        $(document).ready(function(){
            var index3_pic=new Swiper('.index3_pic',{
                loop:true,
                pagination : '.swiper-pagination',
                autoplay: 2500
            });
            var mes=new Swiper('.mes',{
                loop:true,
                autoplay: 3000,
                direction: 'vertical'
            });
            var dongt=new Swiper('.dongt',{
                autoHeight: true,
                onSlideChangeStart:function (swiper) {
                    var _index=swiper.activeIndex;
                    $('.index_7 .tit li').eq(_index).addClass('on').siblings().removeClass('on');
                }
            });
            $('.index_7 .tit li').on('click',function () {
                var _index=$(this).index();
                dongt.slideTo(_index);
            });
            $("#apply_submit").click(function(){
              var formData=$(this).parents("form").serialize();
              var form_url=$(this).parents("form").attr('action');
              if($("#apply_submit").attr('is')!=false){
                $("#apply_submit").attr("is",false);
                $.ajax({
                  type: "POST",
                  url:form_url,
                  data:formData,
                  success:function(data){
                    alert(data.message);
                  },
                  error:function(data){
                    var obj = new Function("return" + data.responseText)();
                    obj = obj.errors;
                    var msg='';
                    $("#apply_submit").attr("is",true);
                    for (var prop in obj){
                        msg += obj[prop]+"\r";
                    }
                    alert(msg);
                  }
                });
              }
            })
        });
    </script>
@endsection
