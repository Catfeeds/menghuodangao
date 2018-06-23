@extends('home.layouts.app')
@section('style')
    @parent
@endsection
@section('content')
@include('home.layouts.banner')
<div class="index_1 lazybg" data-bg="{{ asset('resources/home/images/bg1.jpg') }}">
    <div class="layout">
        <div class="title"><h3>{{$index_1_cate['title']}}<em>{{$index_1_cate['en_title']}}</em></h3></div>
        <div class="tab">
            <div class="hd">
                <ul class="clearfix">
                    @foreach($index_1 as $k=>$v)
                        <li>{{$v['title']}}</li>
                    @endforeach
                </ul>
            </div>
            <div class="bd">
                @foreach($index_1 as $i1)
                    <div class="con">
                        <dl class="clearfix cou_list">
                            @foreach($i1['article'] as $k=>$v)
                                @if($k%4 < 2)
                                <dd class="clearfix">
                                    <div class="pich fl"><a href="{{URL('show-'.$v['cate_id'].'-'.$v['id'].'-1.html')}}"><img src="{{asset($v['img'])}}" alt="{{$v['alt']}}"></a></div>
                                    <div class="box fr">
                                        <div class="pic"><img src="{{asset($v['img2'])}}" alt="{{$v['alt2']}}"></div>
                                        <div class="p1" title="{{$v['en_title']}}">{{$v['en_title']}}</div>
                                        <div class="p2" title="{{$v['title']}}">{{$v['title']}}</div>
                                        <div class="p3">
                                            {!!nl2br($v['desc'])!!}
                                        </div>
                                        <a href="{{URL('show-'.$v['cate_id'].'-'.$v['id'].'-1.html')}}" class="mbtn"><b>了解详情</b></a>
                                    </div>
                                </dd>
                                @else
                                <dd class="clearfix">
                                    <div class="box fl">
                                        <div class="pic"><img src="{{asset($v['img2'])}}" alt="{{$v['alt2']}}"></div>
                                        <div class="p1" title="{{$v['en_title']}}">{{$v['en_title']}}</div>
                                        <div class="p2" title="{{$v['title']}}">{{$v['title']}}</div>
                                        <div class="p3">
                                            {!!nl2br($v['desc'])!!}
                                        </div>
                                        <a href="{{URL('show-'.$v['cate_id'].'-'.$v['id'].'-1.html')}}" class="mbtn"><b>了解详情</b></a>
                                    </div>
                                    <div class="pich fr"><a href="{{URL('show-'.$v['cate_id'].'-'.$v['id'].'-1.html')}}"><img src="{{asset($v['img'])}}" alt="{{$v['alt']}}"></a></div>
                                </dd>
                                @endif
                            @endforeach
                            <?php 
                                $ads_13 = ads_image(13,1);
                            ?>
                            @if($ads_13&&$ads_13->count())
                            <dt class="lazybg clearfix">
                                <a @if(!empty($ads_13['0']['url'])) href="{{$ads_13['0']['url']}}" @endif>
                                    <img src="{{asset($ads_13['0']['image'])}}" alt="{{$ads_13['0']['alt']}}">
                                </a>
                            </dt>
                            @endif
                        </dl>
                        <div class="twobtn">
                            <div class="dis">
                                <a href="{{URL('list-'.$index_1_cate['id'].'-1.html')}}">查看更多课程</a>
                                <a href="{{ConfigGet('kefu_53')}}" target="_blank">获取课程报价</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<div class="index_2 lazybg" data-bg="{{ asset('resources/home/images/bg2.jpg') }}">
    <div class="layout">
        <div class="title title2"><h3>{{$index_2_cate['title']}}<em>{{$index_2_cate['en_title']}}</em></h3></div>
        <div class="tab">
            <div class="hd">
                <ul class="clearfix">
                    @foreach($index_2 as $k=>$v)
                        <li>{{$v['title']}}</li>
                    @endforeach
                </ul>
            </div>
            <div class="bd">
                @foreach($index_2 as $i2)
                <div class="con">
                    <ul class="clearfix">
                        @foreach($i2['article'] as $k=>$v)
                        <li><a class="pich"><img src="{{asset($v['img'])}}" alt="{{$v['alt']}}"></a></li>
                        @endforeach
                    </ul>
                    <div class="twobtn">
                        <div class="dis">
                            <a href="{{URL('list-'.$i2['id'].'-1.html')}}">查看更多作品</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<div class="index_3 lazybg" data-bg="{{ asset('resources/home/images/bg3.jpg') }}">
    <div class="layout">
        <div class="title"><h3>{{$index_3_cate['title']}}<em>{{$index_3_cate['en_title']}}</em></h3></div>
        <div class="picshow">
            @foreach($index_3 as $k3=>$i3)
                @if($k3%6==0)
                <div>
                    <div class="box clearfix">
                @endif
                    @if($k3%6==0)
                    <div class="fl">
                    @endif
                    @if($k3%6==2)
                    <div class="fr clearfix">
                    @endif
                        <div class="pich">
                            <a href="{{URL('show-'.$i3['cate_id'].'-'.$i3['id'].'-1.html')}}">
                                @if($k3%6 < 2)
                                <img src="{{asset($i3['img2'])}}" alt="{{$i3['alt2']}}">
                                @else
                                <img src="{{asset($i3['img'])}}" alt="{{$i3['alt']}}">
                                @endif
                                <p>{{$i3['title']}}</p>
                            </a>
                        </div>
                    @if($k3%6==1||$index_3->count()-1==$k3||$k3%6==5)
                    </div>
                    @endif
                @if($k3%6==5||$index_3->count()-1==$k3)
                    </div>
                </div>
                @endif
            @endforeach
        </div>
        <div class="twobtn">
            <div class="dis">
                <a href="{{URL('list-'.$index_3_cate['id'].'-1.html')}}">查看更多学校实况</a>
            </div>
        </div>
    </div>
</div>
<div class="index_4 lazybg" data-bg="{{ asset('resources/home/images/bg4.jpg') }}">
    <div class="layout">
        <div class="title title2"><h3>{{$index_4_cate['title']}}<em>{{$index_4_cate['en_title']}}</em></h3></div>
        <div class="clearfix tab">
            <div class="bd">
                @foreach($index_4 as $k4=>$i4)
                @if($k4 < 3)
                <div class="video">
                    <!-- <embed src="{{$i4['video']}}" allowFullScreen="true" quality="high" width="582" height="341" align="middle" allowScriptAccess="always" type="application/x-shockwave-flash"></embed> -->
                    <iframe frameborder="0" width="582" height="341" src="{{$i4['video']}}" allowfullscreen></iframe>
                <!-- <img src="images/pic10.jpg"><b></b> -->
                </div>
                @endif
                @endforeach
            </div>
            <div class="hd">
                <ul>
                    @foreach($index_4 as $k4=>$i4)
                    @if($k4 < 3)
                        <li class="clearfix">
                            <div class="time"><b>{{date('d',strtotime($i4['add_time']))}}</b>{{date('Y/m',strtotime($i4['add_time']))}}</div>
                            <div class="w">
                                <h3>{{$i4['title']}}</h3>
                                <p>{!!nl2br($i4['desc'])!!}<a href="{{URL('show-'.$i4['cate_id'].'-'.$i4['id'].'-1.html')}}">【详情】</a></p>
                            </div>
                        </li>
                    @endif
                    @endforeach
                </ul>
            </div>
        </div>
        <ul class="news_list clearfix">
            @foreach($index_4 as $k4=>$i4)
            @if($k4 > 2)
            <li><a href="{{URL('show-'.$i4['cate_id'].'-'.$i4['id'].'-1.html')}}">{{$i4['title']}}：{!!nl2br($i4['desc'])!!}</a></li>
            @endif
            @endforeach
        </ul>
        <div class="twobtn">
            <div class="dis">
                <a href="{{URL('list-'.$index_4_cate['id'].'-1.html')}}">查看更多案例</a>
            </div>
        </div>
    </div>
</div>
<div class="index_5 lazybg" data-bg="{{ asset('resources/home/images/bg5.jpg') }}">
    <div class="layout">
        <div class="title"><h3>{{$index_5_cate['title']}}<em>{{$index_5_cate['en_title']}}</em></h3></div>
        <div class="con">
            {!!$index_5_cate['content']!!}
        </div>
        <div class="twobtn">
            <div class="dis">
                <a href="{{URL('list-5-1.html')}}">查看关于萌货</a>
            </div>
        </div>
    </div>
</div>
<div class="index_6 lazybg" data-bg="{{ asset('resources/home/images/bg6.jpg') }}">
    <div class="layout">
        <div class="title title2"><h3>{{$index_6_cate['title']}}<em>{{$index_6_cate['en_title']}}</em></h3></div>
        <div class="con">
            <ul class="clearfix">
                @foreach($index_6 as $i6)
                    <li>
                        <a href="{{URL('show-'.$i6['cate_id'].'-'.$i6['id'].'-1.html')}}" class="clearfix">
                            <div class="pich"><img src="{{asset($i6['img'])}}" alt="{{$i6['alt']}}"></div>
                            <div class="w">
                                <div class="ic"><img src="{{asset($i6['img2'])}}" alt="{{$i6['alt2']}}"></div>
                                <h3>{{$i6['title']}}</h3>
                                <p class="dot">{!!nl2br($i6['desc'])!!}</p>
                            </div>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="twobtn">
            <div class="dis">
                <a href="{{ConfigGet('kefu_53')}}" target="_blank">课程咨询</a>
            </div>
        </div>
    </div>
</div>
<div class="index_7 lazybg" data-bg="{{ asset('resources/home/images/bg7.jpg') }}">
    <div class="layout">
        <div class="title title2"><h3>{{$index_7_cate['title']}}<em>{{$index_7_cate['en_title']}}</em></h3></div>
        <dl class="clearfix">
            @foreach($index_7 as $k7=>$i7)
            @if($k7 < 1)
                <dt>
                <a href="{{URL('show-'.$i7['cate_id'].'-'.$i7['id'].'-1.html')}}"><img src="{{asset($i7['img'])}}" alt="{{$i7['alt']}}"><p>{{$i7['title']}}</p></a>
                </dt>
            @endif
            @endforeach
            <dd class="clearfix">
                @foreach($index_7 as $k7=>$i7)
                @if($k7 > 0)
                    <div class="pic"><a href="{{URL('show-'.$i7['cate_id'].'-'.$i7['id'].'-1.html')}}"><img src="{{asset($i7['img'])}}" alt="{{$i7['alt']}}"><p>{{$i7['title']}}</p></a></div>
                @endif
                @endforeach
            </dd>
        </dl>
        <div class="twobtn">
            <div class="dis">
                <a href="{{ConfigGet('kefu_53')}}" target="_blank">课程咨询</a>
            </div>
        </div>
    </div>
</div>
<div class="index_8">
    <div class="layout clearfix con">
        <div class="fl">
            <div class="tit">{{$index_8_cate['title']}}<span>/{{$index_8_cate['en_title']}}</span></div>
            <div class="mes_g">
                <div class="bd">
                    <ul>
                        @foreach($index_8 as $k8=>$i8)
                        <li><a href="{{URL('show-'.$i8['cate_id'].'-'.$i8['id'].'-1.html')}}">{{$i8['title']}}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="fl">
            <div class="tit">{{$index_9_cate['title']}}<span>/{{$index_9_cate['en_title']}}</span></div>
            <div class="mes_g">
                <div class="bd">
                    <ul>
                        @foreach($index_9 as $k9=>$i9)
                        <li><a href="{{URL('show-'.$i9['cate_id'].'-'.$i9['id'].'-1.html')}}">{{$i9['title']}}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="fr">
            <div class="tit">抢免费课程<span>/free course</span></div>
            <a class="box">
                <p>今天报名登记送出 <b>10</b> 位免费课程，免费课程今天仅剩 <b>3</b> 位<em>今天送完即止，明天再来。</em></p>
            </a>
        </div>
    </div>
</div>
@endsection
@section('script')
    @parent
    <script>
        $(document).ready(function(){
            $(".index_3 .picshow .pich").hover(function() {
                $(this).find("p").stop().show().animate({
                    "bottom": "0"
                }, 500)
            }, function() {
                $(this).find("p").stop().hide().animate({
                    "bottom": "-140px"
                }, 1)
            });
            $(".index_7 dl a").hover(function() {
                $(this).find("p").stop().show().animate({
                    "bottom": "0"
                }, 500)
            }, function() {
                $(this).find("p").stop().hide().animate({
                    "bottom": "-140px"
                }, 1)
            });
        });
    </script>
@endsection