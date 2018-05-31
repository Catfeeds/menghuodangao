<script type="text/javascript">
	$(window).resize(function(){
		$(".iframe").height($("#pjax-container").css("min-height"));
	})
	$(function(){
		$(".iframe").height($("#pjax-container").css("min-height"));
		$("#browser").on('click',"a",function(){
			$("#browser").find(".curSelectedNode").removeClass('curSelectedNode');
			$(this).addClass('curSelectedNode');
			$('#box-container').attr('src',$(this).attr('href'));
			return false;
		})
		var setting = {
			data: {
				key: {
					name: "title"
				},
				simpleData: {
					enable: true,
					idKey: "id",
					pIdKey: "parent_id"
				}
			}
		};
		console.log(1);
		$.fn.zTree.init($("#browser"), setting, {!!$ArticleCategory!!});
	})
</script>
<div style="height: 100%; overflow-y: auto;float:left;width:15%;" class="iframe">
	<ul id="browser" class="ztree"></ul>
</div>
<div style="height: 100%; float:left;width: 85%;" class="iframe" >
	<iframe src="{{URL('admin/article')}}?no_header=true&no_sidebar=true&no_footer=true" frameborder="0"  width="100%" height="100%" id="box-container" frameborder="0" scrolling="yes" name="box-container"></iframe>
</div>