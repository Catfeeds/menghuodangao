@section('footer')
    <div class="foot">
        <div class="fmenu">
            <div class="layout">
                <ul class="clearfix">
                    @foreach(nav(2) as $k=>$v)
                    <li><a @if(!empty($v['url']))href="{{$v['url']}}"@endif @if($v['is_blank']) target="_blank" @endif title="{{$v['title'] or ''}}">{{$v['title'] or ''}}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="layout clearfix fmid">
            <div class="fl">
                <a href="/" class="logo" style="background-image: url({{asset(ConfigGet('logo'))}});"></a>
                <ul>
                    <li>{{ConfigGet('address')}}</li>
                    @foreach(explode(",",ConfigGet('lianxiren')) as $k=>$v)
                    <li>{{$v}}</li>
                    @endforeach
                    <li>
                        <dl class="clearfix">
                            <dt>友情链接：</dt>
                            @foreach(link_get() as $v)
                            <dd><a href="{{$v['url']}}" target="_blank">{{$v['title']}}</a></dd>
                            @endforeach
                        </dl>
                    </li>
                </ul>
            </div>
            <div class="fr">
                <div class="tell">
                    <p>{!!ConfigGet('phone')!!}</p>
                    {{ConfigGet('pingpai')}}
                </div>
                <div class="fewm bdsharebuttonbox">
                    <a class="bds_sqq" data-cmd="sqq" title="分享到QQ" ></a>
                    <a class="bds_weixin" data-cmd="weixin" title="分享到微信"></a>
                    <a class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a>
                    <div class="ewm"><img src="{{asset(ConfigGet('ewm'))}}"></div>
                </div>
                <script>
                window._bd_share_config={
                    "common":{
                        "bdSnsKey":{},
                        "bdText":"",
                        "bdMini":"2",
                        "bdMiniList":false,
                        "bdPic":"",
                        "bdStyle":"2",
                        "bdSize":"16"
                    },"share":{

                    },
                };
                with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?cdnversion='+~(-new Date()/36e5)];
                </script>
            </div>
        </div>
        <div class="copyright layout">{{ConfigGet('copyright')}} {{ConfigGet('beian')}} <script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cspan id='cnzz_stat_icon_1273747108'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s22.cnzz.com/z_stat.php%3Fid%3D1273747108%26show%3Dpic' type='text/javascript'%3E%3C/script%3E"));</script></div>
    </div>
@show