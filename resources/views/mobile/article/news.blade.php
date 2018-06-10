@extends('mobile.layouts.app')
@section('style')
    @parent
@endsection
@section('content')
@include('mobile.layouts.banner')
<div class="news_list">
    <ul>
        @foreach($article_list as $k=>$v)
        <li><a href="{{URL('show-'.$v['cate_id'].'-'.$v['id'].'-1.html')}}">{{$v['title']}}</a></li>
        @endforeach
    </ul>
    @include('mobile.layouts.page',['page'=>$article_list])
</div>
@include('mobile.layouts.list_b')
@endsection
@section('script')
    @parent
@endsection