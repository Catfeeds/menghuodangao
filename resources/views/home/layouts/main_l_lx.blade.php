<div class="main_l_lx">
    <div class="main_l_t">
        <h3>联系我们</h3>
        <span class="title_bg"></span>
    </div>
    <ul class="list clearfix">
        @foreach(explode(",",ConfigGet('phone')) as $v)
        <p>{{$v}}</p>
        @endforeach
    </ul>
</div>