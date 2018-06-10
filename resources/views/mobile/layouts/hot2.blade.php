<div class="brand6 layout">
    <div class="tit2"><a href="{{URL('list-6-1.html')}}">更多课程</a><h3>至今报名热门课程/<em>hot list</em></h3></div>
    <div class="clearfix">
        <ul class="list2 slist2 clearfix">
            @foreach(ads_image(14,4) as $v)
            <li><a @if(!empty($v['url'])) href="{{$v['url']}}" @endif><img src="{{asset($v['image'])}}" alt="{{$v['alt']}}"></a></li>
            @endforeach
        </ul>
    </div>
</div>