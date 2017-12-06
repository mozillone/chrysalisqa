@if ($paginator->hasPages())
    <ul class="pagination">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="hidden-md hidden-lg"><span><<</span></li>
            <li class="hidden-xs hidden-sm  disabled"><span>Previous</span></li>
        @else
             <li class="hidden-md hidden-lg"><a href="{{ $paginator->previousPageUrl() }}" rel="prev"><<</a></li>
            <li class="hidden-xs hidden-sm"><a href="{{ $paginator->previousPageUrl() }}" rel="prev">Previous</a></li>
        @endif

        {{-- Pagination Elements --}}
        @if($paginator->currentPage() > 3)
            <li class="hidden-xs"><a href="{{ $paginator->url(1) }}">1</a></li>
        @endif
        @if($paginator->currentPage() > 4)
            <li class="disabled hidden-xs"><span>...</span></li>
        @endif
        @foreach(range(1, $paginator->lastPage()) as $i)
            @if($i >= $paginator->currentPage() - 2 && $i <= $paginator->currentPage() + 2)
                @if ($i == $paginator->currentPage())
                    <li class="active"><span>{{ $i }}</span></li>
                @else
                    <li><a href="{{ $paginator->url($i) }}">{{ $i }}</a></li>
                @endif
            @endif
        @endforeach
        @if($paginator->currentPage() < $paginator->lastPage() - 3)
            <li class="disabled hidden-xs"><span>...</span></li>
        @endif
        @if($paginator->currentPage() < $paginator->lastPage() - 2)
            <li class="hidden-xs"><a href="{{ $paginator->url($paginator->lastPage()) }}">{{ $paginator->lastPage() }}</a></li>
        @endif
        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())

            <li class="hidden-md hidden-lg"><a href="{{ $paginator->nextPageUrl() }}" rel="next">>></a></li>

            <li class="hidden-xs hidden-sm"><a href="{{ $paginator->nextPageUrl() }}" rel="next">Next</a></li>
        @else
            <li class="hidden-md hidden-lg disabled"><span>>></span></li>
            <li class="hidden-sm hidden-sm disabled"><span>Next</span></li>
        @endif
    </ul>
@endif