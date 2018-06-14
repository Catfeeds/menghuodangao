@extends('home.layouts.app')

@section('style')

    @parent

@endsection

@section('content')

@include('home.layouts.banner')

<div class="main">

    <div class="nav layout">

        <ul class="dis">

            @foreach($cate_list as $k=>$v)

                <li @if($k==0) class="on" @endif><a>{{$v['title']}}</a></li>

            @endforeach

        </ul>

    </div>

    @foreach($cate_list as $k=>$v)

        @if($v['template']=='single-detail')

        <div class="brand1 turn">

            <div class="intit">{{$v['title']}}<span>{{$v['en_title']}}</span></div>

            <div class="con clearfix">

                {!!$v['content']!!}

            </div>

        </div>

        @elseif($v['template']=='development')

        <div class="brand4 turn">

            <div class="intit">{{$v['title']}}<span>{{$v['en_title']}}</span></div>

            <div class="tabpic">

                @foreach($v['article'] as $k2=>$v2)

                <div>

                    <div class="box">

                        <img src="{{asset($v2['img'])}}" alt="{{$v2['alt']}}">

                        <div class="bg">

                            <div class="w">

                                <h3>{{$v2['title']}}</h3>

                                <h4>{{$v2['title2']}}</h4>

                                <p class="dot">{!!nl2br($v2['desc'])!!}</p>

                            </div>

                        </div>

                    </div>

                </div>

                @endforeach

            </div>

            <div class="nav_c">

                @foreach($v['article'] as $k2=>$v2)

                <div><p>{{$v2['title']}}</p></div>

                @endforeach

            </div>

        </div>

        @elseif($v['template']=='wishes')

        <div class="brand5 turn">

            <div class="intit">{{$v['title']}}<span>{{$v['en_title']}}</span></div>

            <dl class="clearfix">

                @foreach($v['article'] as $k2=>$v2)

                @if($k2 < 2)

                <dd><img src="{{asset($v2['img'])}}" alt="{{$v2['alt']}}"></dd>

                @endif

                @endforeach

            </dl>

            <ul class="clearfix">

                @foreach($v['article'] as $k2=>$v2)

                @if($k2 > 1)

                <li><a ><img src="{{asset($v2['img'])}}" alt="{{$v2['alt']}}"></a></li>

                @endif

                @endforeach

            </ul>

            @if(isset($v['article'])&&$v['article']->count() > 2)

            <div class="click">查看更多</div>

            @endif

        </div>

        @elseif($v['template']=='news')

        <div class="brand6 turn">

            <div class="intit">{{$v['title']}}<span>{{$v['en_title']}}</span></div>

            <ul class="list1 clearfix">

                @foreach($v['article'] as $k2=>$v2)

                <li>

                    <a href="{{URL('show-'.$v2['cate_id'].'-'.$v2['id'].'-1.html')}}">

                        <div class="pich"><img src="{{asset($v2['img'])}}" alt="{{$v2['alt']}}"></div>

                        <p>{{$v['title']}}</p>

                    </a>

                </li>

                @endforeach

            </ul>

        </div>

        @endif

    @endforeach

    @include('home.layouts.hot')

</div>

@endsection

@section('script')

    @parent

    <script>

        $(document).ready(function(){

            $('.tabpic').slick({

                infinite:false,

                arrows: true,

                asNavFor: '.nav_c'

            });

            $('.nav_c').slick({

                infinite:false,

                arrows: false,

                slidesToShow: 5,

                asNavFor: '.tabpic',

                focusOnSelect: true

            });

            side('.nav li','.turn','on');

            $(".brand5 .click").toggle(function() {

                $(this).parents('.brand5').children('ul').slideDown(500);

                $(this).text('收起更多').addClass('on');

            }, function() {

                $(this).parents('.brand5').children('ul').slideUp(300);

                $(this).text('查看更多').removeClass('on');

            });

        });

    </script>

@endsection