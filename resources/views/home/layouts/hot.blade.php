<div class="brand6 layout">
    <div class="tit2"><a href="{{URL('list-6-1.html')}}">更多课程</a><h3>至今报名热门课程/<em>hot list</em></h3></div>
    <div class="clearfix">
        <ul class="list2 clearfix">
            @foreach(ads_image(14,4) as $v)
            <li><a @if(!empty($v['url'])) href="{{$v['url']}}" @endif><img src="{{asset($v['image'])}}" alt="{{$v['alt']}}"></a></li>
            @endforeach
        </ul>
        <div class="list3">
            <h3><a href="{{URL('list-27-1.html')}}">更多新闻</a>萌货热点新闻</h3>
            <ul>
                @foreach($new_recommend_list as $k=>$v)
                <li><a href="{{URL('show-'.$v['cate_id'].'-'.$v['id'].'-1.html')}}" title="{{$v['title']}}"><i>[新闻]</i>{{$v['title']}}</a></li>
                @endforeach
            </ul>
        </div>
    </div>
</div>