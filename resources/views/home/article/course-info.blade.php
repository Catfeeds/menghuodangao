@extends('home.layouts.app')
@section('style')
    @parent
@endsection
@section('content')
<div class="course-info">
    {!!$info['content']!!}
</div>
<div class="main">
	@include('home.layouts.hot')
</div>
@endsection
@section('script')
    @parent
@endsection