<ul class="page2">
    <li><a @if($prev_article) href="{{URL('show-'.$prev_article['cate_id'].'-'.$prev_article['id'].'-1.html')}}" @endif>上一篇：{{$prev_article['title'] or '暂无'}}</a></li>
    <li><a @if($next_article) href="{{URL('show-'.$next_article['cate_id'].'-'.$next_article['id'].'-1.html')}}" @endif>下一篇：{{$next_article['title'] or '暂无'}}</a></li>
</ul>