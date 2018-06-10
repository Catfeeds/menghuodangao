@extends('mobile.layouts.app')
@section('style')
    @parent
@endsection
@section('content')
@include('mobile.layouts.banner')
<div class="teacher_det">
    <div class="box clearfix">
        <div class="w">
            <p><em>{{$info['title'] or ''}}</em></p>
            <span><em>{{$info['desc'] or ''}}</em></span>
        </div>
        <div class="pic"><img src="{{asset($info['img'])}}" alt="{{$info['alt']}}"></div>
    </div>
    <div class="box2 mobile_content">
        {!!$info['content']!!}
    </div>
    <div class="box3">
        <div class="tit"><span>教学互动<em>/Teaching interaction</em></span></div>
        <div class="pic lunbo">
            <div class="swiper-wrapper">
                @foreach($info['MoreImageMany'] as $k=>$v)
                <div class="swiper-slide"><img src="{{asset($v['image'])}}" alt="{{$v['alt']}}"></div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@include('mobile.layouts.list_b')
@endsection
@section('script')
    @parent
    <script type="text/javascript">
        $(function(){
            var lunbo=new Swiper('.lunbo',{
                loop:true,
                pagination : '.swiper-pagination',
                autoplay: 2500
            });
        })
    </script>
@endsection