@if(isset($page)&&$page->lastPage()>1)
<div class="page">
	<div class="dis">
		{{$page->links('mobile.layouts.page-default')}}
	</div>
</div>
@endif