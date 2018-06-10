<div class="nav layout">
    <ul class="dis">
    	@foreach($sub_category as $k=>$v)
        <li @if(in_array("list-".$v['id']."-1.html",$url)) class="on" @endif><a href="{{URL("list-".$v['id']."-1.html")}}" title="{{$v['title']}}">{{$v['title']}}</a></li>
    	@endforeach
    </ul>
</div>