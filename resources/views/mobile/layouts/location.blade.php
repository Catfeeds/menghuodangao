<div class="loca layout">
	<p>
	您现在的位置：
	<a href="/">萌货首页</a>
    @foreach($location as $k=>$v)
	    <em>&gt;</em>
	    <a @if(!empty($v['url'])) href="{{$v['url']}}" @endif>{{$v['title']}}</a>
    @endforeach
	</p>
</div>