<!DOCTYPE html>
<html>
<head>
    <title>加盟申请</title>
</head>
<body>
    <table>
    	<tr>
    		<td width="80">姓名</td>
    		<td>{{$info['name'] or ''}}</td>
    	</tr>
    	<tr>
    		<td>联系方式</td>
    		<td>{{$info['phone'] or ''}}</td>
    	</tr>
    	<tr>
    		<td>邮箱</td>
    		<td>{{$info['email'] or ''}}</td>
    	</tr>
    	<tr>
    		<td>联系地址</td>
    		<td>{{$info['address'] or ''}}</td>
    	</tr>
    	<tr>
    		<td>备注</td>
    		<td>
    			@if(isset($info['remark']))
    				{!!nl2br($info['remark'])!!}
				@endif
    		</td>
    	</tr>
    </table>
</body>
</html>