@extends('home.layouts.app')
@section('style')
    @parent
@endsection
@section('content')
@include('home.layouts.banner')
<div class="main">
    <div class="tearch">
        <div class="tit"><img src="{{asset($cate_info['img'])}}" alt="{{$cate_info['alt']}}"></div>
        <ul class="clearfix">
            @foreach($article_list as $k=>$v)
            <li>
                <div class="pic"><a href="{{URL('show-'.$v['cate_id'].'-'.$v['id'].'-1.html')}}"><img src="{{asset($v['img'])}}" alt="{{$v['alt']}}"></a></div>
                <div class="box">
                    <h3 title="{{$v['title']}}">{{$v['title']}}</h3>
                    <p title="{!!nl2br($v['desc'])!!}">{!!nl2br($v['desc'])!!}</p>
                    <a href="{{URL('show-'.$v['cate_id'].'-'.$v['id'].'-1.html')}}" class="mbtn"><b>了解更多</b></a>
                </div>
            </li>
            @endforeach
        </ul>
    </div>
    @include('home.layouts.page',['page'=>$article_list])
    @include('home.layouts.hot2')
</div>
@endsection
@section('script')
    @parent
@endsection