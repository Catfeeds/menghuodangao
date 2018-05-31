@section('header')
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
    </div>
@show