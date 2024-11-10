<div class="col-12">
    <div class="pagination d-flex justify-content-center mt-5">
        @if ($paginator->onFirstPage())
        <span class="rounded disabled"></span>
        @else
        <a href="{{ $paginator->previousPageUrl() }}" class="rounded">&laquo;</a>
        @endif

        @for ($i = 1; $i <= $paginator->lastPage(); $i++)
            @if ($i == $paginator->currentPage())
            <a href="#" class="active rounded" style="background-color: #81c408; color: white;">{{ $i }}</a>
            @else
            <a href="{{ $paginator->url($i) }}" class="rounded" style="color: #81c408;">{{ $i }}</a>
            @endif
            @endfor

            @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="rounded">&raquo;</a>
            @else
            <span class="rounded disabled"></span>
            @endif
    </div>
</div>