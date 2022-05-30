@props(['paginator'])

@if ($paginator->previousPageUrl())
    <x-pagination-link href="{{ $paginator->previousPageUrl() }}">
        <i class="bx bx-left-arrow-alt ml-1 text-primary transition-colors group-hover:text-secondary dark:text-white"></i>
        Previous
    </x-pagination-link>
@endif

@if ($paginator->hasMorePages())
<x-pagination-link href="{{ $paginator->nextPageUrl() }}">
    Next
    <i class="bx bx-right-arrow-alt ml-1 text-primary transition-colors group-hover:text-secondary dark:text-white"></i>
</x-pagination-link>
@endif