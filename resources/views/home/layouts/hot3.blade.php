<div class="mr">
    <div class="box">
        <div class="tit">至今报名热门课程/hot list</div>
        <ul class="list2 mrlist clearfix">
            @foreach(ads_image(14,4) as $v)
            <li><a @if(!empty($v['url'])) href="{{$v['url']}}" @endif><img src="{{asset($v['image'])}}" alt="{{$v['alt']}}"></a></li>
            @endforeach
        </ul>
    </div>
    <div class="blank30"></div>
    <div class="box">
        <div class="tit">萌货新闻/new</div>
        <ul class="mrlist2">
            @foreach($new_recommend_list as $k=>$v)
            <li>
                <a href="{{URL('show-'.$v['cate_id'].'-'.$v['id'].'-1.html')}}" title="{{$v['title']}}">
                    <div class="pic"><img src="{{$v['img']}}" alt="{{$v['alt']}}"></div>
                    <p>{{$v['title']}}</p>
                </a>
            </li>
            @endforeach
        </ul>
    </div>
    <div class="blank30"></div>
    <?php 
        $ads_13 = ads_image(13,1);
    ?>
    @if($ads_13&&$ads_13->count())
    <div class="box">
        <div class="tit">联系客服老师/contact</div>
        <div class="cpic">
            <a @if(!empty($ads_13['0']['url'])) href="{{$ads_13['0']['url']}}" @endif>
                <img src="{{asset($ads_13['0']['image'])}}" alt="{{$ads_13['0']['alt']}}">
            </a>
        </div>
    </div>
    @endif
</div>