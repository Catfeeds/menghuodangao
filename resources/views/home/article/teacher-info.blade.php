@extends('home.layouts.app')
@section('style')
    @parent
@endsection
@section('content')
@include('home.layouts.banner')
<div class="main">
    <div class="baby clearfix">
        <div class="pic"><img src="{{asset($info['img'])}}" alt="{{$info['alt']}}"></div>
        <div class="w">
            <h3>{{$info['title'] or ''}}</h3>
            <div class="con">
                {!!$info['content']!!}
            </div>
        </div>
    </div>
    <ul class="show_list clearfix">
        @foreach($info['MoreImageMany'] as $k=>$v)
        <li><a ><img src="{{asset($v['image'])}}" alt="{{$v['alt']}}"></a></li>
        @endforeach
    </ul>
    @include('home.layouts.hot')
</div>
@endsection
@section('script')
    @parent
@endsection