@extends('mobile.layouts.app')
@section('style')
    @parent
@endsection
@section('content')
@include('mobile.layouts.banner')
@foreach($cate_list as $k_c=>$v_c)
@if($v_c['template']=='media-witness')
<div class="story_list">
    <div class="tit">{{$v_c['title']}}</div>
    <ul class="clearfix">
        @foreach($v_c['article'] as $k=>$v)
        <li>
            <a href="{{URL('show-'.$v['cate_id'].'-'.$v['id'].'-1.html')}}">
                <div class="pic"><img src="{{asset($v['img'])}}" alt="{{$v['alt']}}"></div>
                <h3>{{$v['title']}}</h3>
                <span>{!!nl2br($v['desc2'])!!}</span>
            </a>
        </li>
        @endforeach
    </ul>
</div>
@elseif($v_c['template']=='cases')
<div class="story_list">
    <div class="tit">{{$v_c['title']='学员案例'?'媒体见证':$v_c['title']}}</div>
    <ul class="clearfix">
        @foreach($v_c['article'] as $k=>$v)
        <li>
            <a href="{{URL('show-'.$v['cate_id'].'-'.$v['id'].'-1.html')}}">
                <div class="pic"><img src="{{asset($v['img'])}}" alt="{{$v['alt']}}"><div class="play"></div></div>
                <p class="dot">{{$v['title']}}</p>
            </a>
        </li>
        @endforeach
    </ul>
</div>
@endif
@endforeach
@include('mobile.layouts.list_b')
@endsection
@section('script')
    @parent
@endsection