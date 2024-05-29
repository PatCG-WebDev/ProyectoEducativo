@props(['orderBy', 'currentOrderBy', 'orderDirection'])

@php
    $isOrdered = ($orderBy === $currentOrderBy);
    $iconClass = $isOrdered ? ($orderDirection === 'asc' ? 'fas fa-arrow-down' : 'fas fa-arrow-up') : '';
@endphp

@if ($isOrdered)
    <i class="{{ $iconClass }}"></i>
@endif
