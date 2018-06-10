@extends('mobile.layouts.app')
@section('style')
    @parent
@endsection
@section('content')
<div class="main">
    <div class="clearfix">
        <div class="ml">
            <div class="news_det">
                <div class="tit">
                    <h3>{{$info['title'] or ''}}</h3>
                    <p>时间：{{date('Y-m-d H:i',strtotime($info['add_time']))}}<em>来源：{{$info['editor']}}</em></p>
                </div>
                <div class="con">
                    {!!$info['content']!!}
                </div>
                @include("mobile.layouts.pagebox")
            </div>
        </div>
        @include('mobile.layouts.hot3')
    </div>
    @include('mobile.layouts.hot')
</div>
@include('mobile.layouts.list_b')
@endsection
@section('script')
    @parent
@endsection