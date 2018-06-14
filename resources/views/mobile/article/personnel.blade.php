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
            </div>
            <div class="main_r">
                @include('home.layouts.top_banner')
            </div>
        </div>
        <div class="student_list">
            <ul class="clearfix">
                @foreach($article_list as $k=>$v)
                <li>
                    <a href="{{URL($cate_info['url'],[$v['id']])}}">
                        <img src="{{asset($v['img'])}}" alt="{{$v['title']}}">
                        <h5 title="{{$v['title']}}">{{$v['title']}}</h5>
                        <p title="{!!nl2br($v['desc'])!!}">{!!nl2br($v['desc'])!!}</p>
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
        @include('home.layouts.page',['page'=>$article_list])
    </div>
</div>
@endsection
@section('script')
    @parent
@endsection