@extends('home.layouts.app')
@section('style')
    @parent
@endsection
@section('content')
@include('home.layouts.banner')
<div class="main main2">
    <div class="nav layout">
        <ul class="dis">
            @foreach($sub_category as $k=>$v)
                <li @if($k==0) class="on" @endif><a>{{$v['title']}}</a></li>
            @endforeach
        </ul>
    </div>
    @foreach($sub_category as $k=>$v)
        <div class="course turn @if($k%2==1) course2 @endif">
            <div class="layout">
                <div class="titimg"><img src="{{asset($v['img'])}}" alt="{{$v['alt']}}"></div>
                <dl class="clearfix cou_list">
                    @foreach($v['article'] as $k=>$v)
                        @if($k%4 < 2)
                        <dd class="clearfix">
                            <div class="pich fl"><a href="{{URL('show-'.$v['cate_id'].'-'.$v['id'].'-1.html')}}"><img src="{{asset($v['img'])}}" alt="{{$v['alt']}}"></a></div>
                            <div class="box fr">
                                <div class="pic"><img src="{{asset($v['img2'])}}" alt="{{$v['alt2']}}"></div>
                                <div class="p1" title="{{$v['en_title']}}">{{$v['en_title']}}</div>
                                <div class="p2" title="{{$v['title']}}">{{$v['title']}}</div>
                                <div class="p3">
                                    {!!nl2br($v['desc'])!!}
                                </div>
                                <a href="{{URL('show-'.$v['cate_id'].'-'.$v['id'].'-1.html')}}" class="mbtn"><b>了解详情</b></a>
                            </div>
                        </dd>
                        @else
                        <dd class="clearfix">
                            <div class="box fl">
                                <div class="pic"><img src="{{asset($v['img2'])}}" alt="{{$v['alt2']}}"></div>
                                <div class="p1" title="{{$v['en_title']}}">{{$v['en_title']}}</div>
                                <div class="p2" title="{{$v['title']}}">{{$v['title']}}</div>
                                <div class="p3">
                                    {!!nl2br($v['desc'])!!}
                                </div>
                                <a href="{{URL('show-'.$v['cate_id'].'-'.$v['id'].'-1.html')}}" class="mbtn"><b>了解详情</b></a>
                            </div>
                            <div class="pich fr"><a href="{{URL('show-'.$v['cate_id'].'-'.$v['id'].'-1.html')}}"><img src="{{asset($v['img'])}}" alt="{{$v['alt']}}"></a></div>
                        </dd>
                        @endif
                    @endforeach
                    <?php 
                        $ads_13 = ads_image(13,1);
                    ?>
                    @if($ads_13&&$ads_13->count())
                    <dt class="lazybg clearfix">
                        <a @if(!empty($ads_13['0']['url'])) href="{{$ads_13['0']['url']}}" @endif>
                            <img src="{{asset($ads_13['0']['image'])}}" alt="{{$ads_13['0']['alt']}}">
                        </a>
                    </dt>
                    @endif
                </dl>
            </div>
        </div>
    @endforeach
    @include('home.layouts.hot')
</div>
@endsection
@section('script')
    @parent
    <script>
        $(document).ready(function(){
            side('.nav li','.turn','on');
        });
    </script>
@endsection