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
    <ul class="pagination clearfix">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="disabled"><span>&lsaquo;</span></li>
        @else
            <li><a href="{{ $previousPageUrl }}" rel="prev">&lsaquo;</a></li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="disabled"><span>{{ $element }}</span></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="active"><span>{{ $page }}</span></li>
                    @else
                        <li><a href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li><a href="{{ $nextPageUrl }}" rel="next">&rsaquo;</a></li>
        @else
            <li class="disabled"><span>&rsaquo;</span></li>
        @endif
    </ul>
@endif