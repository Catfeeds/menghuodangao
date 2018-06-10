@extends('mobile.layouts.app')
@section('style')
    @parent
@endsection
@section('content')
<div class="det_box">
    <div class="tit">{{$info['title'] or ''}}</div>
    <div class="time">日期：{{date('Y-m-d H:i',strtotime($info['add_time']))}}<em>浏览量：{{$info['click']}}</em></div>
    <div class="con">
    	@if(!empty($info['video']))
			<iframe frameborder="0" width="100%" src="{{$info['video']}}" allowfullscreen></iframe>
    	@endif
        {!!$info['content']!!}
    </div>
</div>
@include("mobile.layouts.pagebox")
@include('mobile.layouts.list_b')
@endsection
@section('script')
    @parent
@endsection