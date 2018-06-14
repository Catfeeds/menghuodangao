@extends('home.layouts.app')
@section('style')
    @parent
@endsection
@section('content')
@include('home.layouts.banner')
@include('home.layouts.location')
<div class="main">
    @include('home.layouts.sub_nav')
    <div class="news school">
        <div class="tit">{{$cate_info['title']}}<span>/{{$cate_info['en_title']}}</span></div>
        <ul class="list4">
            @foreach($article_list as $k=>$v)
            <li>
                <a href="{{URL('show-'.$v['cate_id'].'-'.$v['id'].'-1.html')}}" class="clearfix">
                    <div class="pic"><img src="{{asset($v['img'])}}" alt="{{$v['alt']}}"></div>
                    <div class="w">
                        <h3 title="{{$v['title']}}">{{$v['title']}}</h3>
                        <p class="dot" title="{!!nl2br($v['desc'])!!}">{!!nl2br($v['desc'])!!}~</p>
                        <span>日期：{{date('Y-m-d',strtotime($v['add_time']))}}</span>
                    </div>
                </a>
            </li>
            @endforeach
        </ul>
    </div>
    @include('home.layouts.hot2')
</div>
@endsection
@section('script')
    @parent
@endsection