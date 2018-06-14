@extends('home.layouts.app')
@section('style')
    @parent
@endsection
@section('content')
@include('home.layouts.banner')
@include('home.layouts.location')
<div class="main">
    @include('home.layouts.sub_nav')
    @if(isset($article_list[0]))
    <div class="news1">
        <a href="{{URL('show-'.$article_list[0]['cate_id'].'-'.$article_list[0]['id'].'-1.html')}}" class="clearfix">
            <div class="pich"><img src="{{asset($article_list[0]['img'])}}" alt="{{$article_list[0]['alt']}}"></div>
            <div class="fr">
                <h3 title="{{$article_list[0]['title']}}">{{$article_list[0]['title']}}</h3>
                <p class="dot" title="{!!nl2br($article_list[0]['desc'])!!}">{!!nl2br($article_list[0]['desc'])!!}</p>
            </div>
        </a>
    </div>
    @endif
    <div class="news">
        <div class="tit">{{$cate_info['title']}}<span>/{{$cate_info['en_title']}}</span></div>
        <ul class="list4">
            @foreach($article_list as $k=>$v)
            @if($k>0)
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
            @endif
            @endforeach
        </ul>
        @include('home.layouts.page',['page'=>$article_list])
        <div class="tit2">
            <img src="{{asset($cate_info['img'])}}" alt="{{$cate_info['alt']}}">
        </div>
        <div class="clearfix">
            <ul class="list5">
                @foreach($article_recommend_list as $k=>$v)
                <li><a href="{{URL('show-'.$v['cate_id'].'-'.$v['id'].'-1.html')}}" title="{{$v['title']}}"><i>{{date('Y-m-d',strtotime($v['add_time']))}}</i><p>{{$v['title']}}</p></a></li>
                @endforeach
            </ul>
        </div>
        <?php 
            $ads_15 = ads_image(15,1);
        ?>
        @if($ads_15&&$ads_15->count())
        <div class="gg">
            <a @if(!empty($ads_15['0']['url'])) href="{{$ads_15['0']['url']}}" @endif>
                <img src="{{asset($ads_15['0']['image'])}}" alt="{{$ads_15['0']['alt']}}">
            </a>
        </div>
        @endif
    </div>
    @include('home.layouts.hot2')
</div>
@endsection
@section('script')
    @parent
@endsection