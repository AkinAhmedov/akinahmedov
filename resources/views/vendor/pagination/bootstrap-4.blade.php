@if ($paginator->hasPages())
    <!-- pagination  -->
    <div class="theme-pagination text-center">
        <ul class="clearfix">
            {{-- Previous Page Link --}}
            @if (!$paginator->onFirstPage())
                <li><a href="{{$paginator->previousPageUrl()}}"  rel="prev" aria-label="@lang('pagination.previous')"><i class="icon flaticon-left-arrow"></i></a></li>
            @endif


            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="disabled"><a href="#">{{ $element }}</a></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="active"><a href="javascript:void(0)">{{ $page }}</a></li>
                        @else
                            <li><a href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach


            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li><a href="{{$paginator->nextPageUrl()}}"  rel="next" aria-label="@lang('pagination.next')"><i class="icon flaticon-right-arrow"></i></a></li>
            @endif
        </ul>
    </div>
@endif
