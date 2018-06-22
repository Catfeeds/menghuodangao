@section('header')
    <div class="header @if(!isset($is_index)||$is_index!=1) inheader @endif">
        @if(isset($is_index)&&$is_index==1) 
        <a href="/" class="logo" style="background-image: url({{asset(ConfigGet('logo'))}});"></a>
        @else
        <a href="javascript:history.go(-1);" class="back"></a>
        <div class="tit">@if(isset($head_title)){{$head_title}}@else{{ConfigGet('site_name')}}@endif</div>
        @endif
        <a href="javascript:void(0);" class="menubtn"></a>
    </div>
    @if(isset($is_course_menu)&&$is_course_menu==1) 
    <div class="menu">
        <dl>
            @foreach($course_menu as $k=>$v)
            @if($v['article']->count())
            <dt>{{$v['title']}}</dt>
                @foreach($v['article'] as $k2=>$v2)
                <dd><a href="{{URL('show-'.$v2['cate_id'].'-'.$v2['id'].'-1.html')}}"><span>{{$v2['day']}}天</span>{{$v2['title']}}</a></dd>
                @endforeach
            @endif
            @endforeach
        </dl>
    </div>
    @else
    <div class="menu">
        <div class="submenu">
            <ul><li><a href="/">首页</a></li>
                @foreach(nav(5) as $k=>$v)
                <li><a @if(!empty($v['url'])) href="{{$v['url']}}" @endif @if($v['is_blank']) target="_blank" @endif title="{{$v['title']}}">{{$v['title']}}</a></li>
                @endforeach
            </ul>
        </div>
    </div>
    @endif
<!-- 
    <div class="header">
        <div class="htop">
            <div class="layout clearfix">
                <a href="/" class="logo" style="background-image: url({{asset(ConfigGet('logo'))}});"></a>
                <div class="tell">
                    <p>{!!ConfigGet('phone')!!}</p>
                    {{ConfigGet('pingpai')}}
                    <div class="wx">
                        <img src="{{asset('/resources/home/images/ic24_02.png')}}" alt="">
                        <div class="ewm"><img src="{{asset(ConfigGet('ewm'))}}"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="hbot">
            <div class="layout menu">
                <ul class="clearfix">
                    @foreach(nav(1) as $k=>$v)
                    <li @if(isset($url)&&in_array(trim($v['url'],"/"),$url)) class="on" @endif>
                        <p><a @if(!empty($v['url']))href="{{$v['url']}}"@endif @if($v['is_blank']) target="_blank" @endif title="{{$v['title']}}">{{$v['title']}}</a></p>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div> -->
@show
