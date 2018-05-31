@extends('home.layouts.app')
@section('style')
    @parent
@endsection
@section('content')
@include('home.layouts.banner')
<div class="main">
    <div class="student">
        <ul class="clearfix">
            @foreach($article_list as $k=>$v)
            <li>
                <a href="{{URL('show-'.$v['cate_id'].'-'.$v['id'].'-1.html')}}">
                    <div class="pic"><img src="{{asset($v['img'])}}" alt="{{$v['alt']}}"></div>
                    <p><em title="{{$v['title']}}">{{$v['title']}}</em>{!!nl2br($v['desc'])!!}</p>
                </a>
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