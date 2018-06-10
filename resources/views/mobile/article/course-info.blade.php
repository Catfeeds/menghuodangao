@extends('mobile.layouts.app')
@section('style')
    @parent
@endsection
@section('content')
<style type="text/css">
	.cou_det .xuefei .tit img{max-width:2.67rem;}
</style>
<div class="cou_det mobile_content">
    {!!$info['content']!!}
</div>
@include("mobile.layouts.pagebox")
@include('mobile.layouts.list_b')
@endsection
@section('script')
    @parent
@endsection