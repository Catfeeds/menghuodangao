@extends('mobile.layouts.app')
@section('style')
    @parent
@endsection
@section('content')
@include('mobile.layouts.banner')
<div class="main main2">
    @foreach($sub_category as $k_c=>$v_c)
        <div class="cou_list">
            <div class="tit">{{$v_c['title']}}<span>/{{$v_c['en_title']}}</span></div>
            <ul>
                @foreach($v_c['article'] as $k=>$v)
                <li><a href="{{URL('show-'.$v['cate_id'].'-'.$v['id'].'-1.html')}}"><span>{{$v['title']}}</span><i>{{$v['day']}}天</i></a></li>
                @endforeach
            </ul>
        </div>
    @endforeach
    @include('mobile.layouts.list_b')
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