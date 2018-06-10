@extends('mobile.layouts.app')
@section('style')
    @parent
@endsection
@section('content')
@include('mobile.layouts.banner')
<div class="teacher_list">
    <ul class="clearfix">
        @foreach($article_list as $k=>$v)
        <li>
            <div class="pic"><a href="{{URL('show-'.$v['cate_id'].'-'.$v['id'].'-1.html')}}"><img src="{{asset($v['img'])}}" alt="{{$v['alt']}}"></a></div>
            <div class="w">
                <h3 title="{{$v['title']}}">{{$v['title']}}</h3>
                <p title="{!!nl2br($v['desc'])!!}">{!!nl2br($v['desc'])!!}</p>
                <span><a href="{{URL('show-'.$v['cate_id'].'-'.$v['id'].'-1.html')}}">了解更多</a></span>
            </div>
        </li>
        @endforeach
    </ul>
    @include('mobile.layouts.page',['page'=>$article_list])
</div>
@include('mobile.layouts.list_b')
@endsection
@section('script')
    @parent
@endsection