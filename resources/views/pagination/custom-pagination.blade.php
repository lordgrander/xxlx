
{{-- Previous Page Link --}}
    @if ($paginator->onFirstPage())
        <button class="disabled btn btn-outline-danger-cus" aria-disabled="true"><span>&laquo;</span></button>
    @else
        <a href="{{ $paginator->previousPageUrl() }}" rel="prev"><button class="btn btn-outline-danger-cus">&laquo;</button></a>
    @endif

    {{-- Pagination Elements --}}
    @foreach ($elements as $element)
        {{-- "Three Dots" Separator --}}
        @if (is_string($element))
            <button class="disabled btn btn-outline-danger-cus" aria-disabled="true"><span>{{ $element }}</span></button>
        @endif

        {{-- Array Of Links --}}
        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                    <button class="active btn btn-danger" aria-current="page"><span>{{ $page }}</span></button>
                @else
                    <a href="{{ $url }}"><button class="btn btn-outline-danger-cus">{{ $page }}</button></a>
                @endif
            @endforeach
        @endif
    @endforeach

    {{-- Next Page Link --}}
    @if ($paginator->hasMorePages())
    <a href="{{ $paginator->nextPageUrl() }}" rel="next"><button class="btn btn-outline-danger-cus">&raquo;</button></a>
    @else
        <button class="disabled btn btn-outline-danger-cus" aria-disabled="true" aria-label="@lang('pagination.next')">
            <span aria-hidden="true">&raquo;</span>
        </button>
    @endif
 