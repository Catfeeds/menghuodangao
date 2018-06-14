@if(isset($banner)&&$banner->count())
<div class="swiper-container banner">
    <div class="swiper-wrapper">
    	@foreach($banner as $v)
        <div class="swiper-slide"><a @if(!empty($v['url']))href="{{$v['url']}}"@endif target="_blank"><img src="{{asset($v['image'])}}" alt="{{$v['alt']}}"></a></div>
    	@endforeach
    </div>
    <div class="swiper-pagination"></div>
</div>
<script type="text/javascript">
	@if(isset($banner)&&$banner->count()>1)
	$(function(){
		var banner=new Swiper('.banner',{
		    loop:true,
		    pagination : '.swiper-pagination',
		    autoplay: 2500
		});
	})
	@endif
</script>
@endif