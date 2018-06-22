<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no, minimal-ui" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<meta name="apple-mobile-web-app-status-bar-style" content="black" />
	<meta name="format-detection" content="telephone=no, email=no" />
	<title>@if(isset($head_title)){{$head_title}}@else{{ConfigGet('site_name')}}@endif</title>
	<meta name="keywords" content="@if(isset($head_keywords)){{$head_keywords}}@else{{ConfigGet('site_keywords')}}@endif">
	<meta name="description" content="@if(isset($head_description)){{$head_description}}@else{{ConfigGet('site_description')}}@endif">
</head>
<style type="text/css">
	*{margin: 0;padding: 0;}
	body,html,table,td,.box404{height: 100%;width: 100%;vertical-align: middle;}
	.box404{text-align: center;font-size: 12px;}
	.box404 .btn{background-color: #00c3f3;width: 150px;line-height: 50px;border-radius: 5px;color:#fff;font-size: 16px;display: block;margin:0 auto;text-decoration: none;}
	.box404 p{margin:30px 0;}
	img{max-width: 100%;}
</style>
<body>
	<div class="box404">
		<table>
			<tr>
				<td>
					<img src="{{asset('resources/error/images/404.png')}}">
					<p>啊哦~一不小心闯进了未知领域，请点击下面按钮返回首页……</p>
					<a href="/" class="btn">返回首页</a>	
				</td>
			</tr>
		</table>
	</div>
</body>
</html>