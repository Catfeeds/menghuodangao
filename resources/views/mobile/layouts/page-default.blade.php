@if ($paginator->hasPages())
    <?php 
    $previousPageUrl = $paginator->previousPageUrl();
    preg_match('/page\=(\d+)/i',$previousPageUrl,$next_page);
    $previousPageUrl= preg_replace("/(.*)-(\d+)-(\d+).html(.*)/","$1-$2-".$next_page[1].".html",$previousPageUrl);

    $nextPageUrl = $paginator->nextPageUrl();
    preg_match('/page\=(\d+)/i',$nextPageUrl,$next_page);
    $nextPageUrl= preg_replace("/(.*)-(\d+)-(\d+).html(.*)/","$1-$2-".$next_page[1].".html",$nextPageUrl);
    
    foreach ($elements as &$element){
        foreach($element as &$v){
            $url = $v;
            preg_match('/page\=(\d+)/i',$url,$page);
            $v = preg_replace("/(.*)-(\d+)-(\d+).html(.*)/","$1-$2-".$page[1].".html",$v);
        }
    }
    ?>
    <a href="{{ $previousPageUrl }}">上一页</a>
    @foreach ($elements as $element)
        @if (is_string($element))
            <span>{{ $element }}</span>
        @endif
        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                    <a href="{{ $url }}" class="on">{{ $page }}</a>
                @else
                    <a href="{{ $url }}">{{ $page }}</a>
                @endif
            @endforeach
        @endif
    @endforeach
    <a href="{{ $nextPageUrl }}">下一页</a>
@endif