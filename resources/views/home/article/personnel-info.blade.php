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
                <div class="main_l_fc">
                    <div class="main_l_t">
                        <h3>更多{{$cate_info['title']}}</h3>
                        <span class="title_bg"></span>
                    </div>
                    <ul class="list clearfix">
                        @foreach($article_recommend_list as $k=>$v)
                        <li>
                            <a href="{{URL($url,[$v['id']])}}" >
                                <img src="{{asset($v['img'])}}" alt="{{$v['title']}}">
                                <h5 title="{{$v['title']}}">{{$v['title']}}</h5>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
                @include('home.layouts.main_l_lx')
                @include('home.layouts.main_l_bm')
            </div>
            <div class="main_r">
                @include('home.layouts.top_banner')
                <div class="article_detail_title">
                    <h4>{{$info['title'] or ''}}</h4>
                    <p>{{date('Y.m.d',strtotime($info['add_time']))}}  |  {{$info['click'] or '0'}}阅读</p>
                </div>
                <div class="single_detail">
                    {!!$info['content']!!}
                </div>
                @include("home.layouts.pagebox")
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
    @parent
@endsection