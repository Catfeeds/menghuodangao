@extends('home.layouts.app')
@section('style')
    @parent
@endsection
@section('content')
<div class="main">
    <div class="wrap">
        <div class="clearfix">
            <div class="main_l">
                @include('home.layouts.location')
                @include('home.layouts.midnav')
            </div>
            <div class="main_r">
                @include('home.layouts.top_banner')
                <div class="contact">
                    <form method="POST" action="{{URL('apply-save')}}">
                    {{ csrf_field() }}
                        <h4>咨询报名</h4>
                        <div class="clearfix w3">
                            <div class="text_box">
                                <label>
                                    <span>姓名：</span>
                                    <input type="text" name="name" class="text" placeholder="必填">
                                </label>
                            </div>
                            <div class="text_box">
                                <label>
                                    <span>联系电话：</span>
                                    <input type="text" name="phone" class="text" placeholder="必填">
                                </label>
                            </div>
                            <div class="text_box">
                                <label>
                                    <span>年龄：</span>
                                    <input type="text" name="age" class="text">
                                </label>
                            </div>
                        </div>
                        <div class="text_box">
                            <label>
                                <span>联系地址：</span>
                                <input type="text" name="address" class="text">
                            </label>
                        </div>
                        <div class="radio_box">
                            <span>学画时间</span>
                            <label><input type="radio" name="years" class="radio" value="1">半年</label>
                            <label><input type="radio" name="years" class="radio" value="2">半年至一年</label>
                            <label><input type="radio" name="years" class="radio" value="3">一年以上</label>
                        </div>
                        <div class="select_box">
                            <span>意向班级</span>
                            <select name="cate_id" id="" class="select">
                                <option value="">请选择意向班级</option>
                                @foreach($class as $v)
                                <option value="{{$v['id']}}">{{$v['title']}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="yzm_box">
                            <span>验证码</span>
                            <input type="text" class="text" name="code">
                            <div class="img yzm">{!!captcha_img()!!}</div>
                            <i class="iconfont icon-shuaxin"></i>
                        </div>
                        <a class="submit" id="apply_submit">提交 —></a>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
@section('script')
    @parent
    <script type="text/javascript">
        $(".yzm").click(function(){
            $(".yzm").find("img").attr('src',"{{captcha_src()}}"+Math.random());
        })
        $(".icon-shuaxin").click(function(){
            $(".yzm").find("img").attr('src',"{{captcha_src()}}"+Math.random());
        })
        $("#apply_submit").click(function(){
          var formData=$(this).parents("form").serialize();
          var form_url=$(this).parents("form").attr('action');
          if($("#apply_submit").attr('is')!=false){
            $("#apply_submit").attr("is",false);
            $.ajax({
              type: "POST",
              url:form_url,
              data:formData,
              success:function(data){
                $(".yzm").find("img").attr('src',"{{captcha_src()}}"+Math.random());
                alert(data.message);
              },
              error:function(data){
                $(".yzm").find("img").attr('src',"{{captcha_src()}}"+Math.random());
                var obj = new Function("return" + data.responseText)();
                obj = obj.errors;
                var msg='';
                $("#apply_submit").attr("is",true);
                for (var prop in obj){
                    msg += obj[prop]+"\r";
                }
                alert(msg);
              }
            });
          }
        })
    </script>
@endsection