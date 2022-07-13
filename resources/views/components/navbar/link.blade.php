{{--
Current: "bg-gray-900 text-white", 
Default: "text-gray-300 hover:bg-gray-700 hover:text-white" 
--}}

@php
    $classesIfMovile = ($isForMobileMenu) ? 'text-base block' : 'text-sm';
    $classesIfSelected = ($isSelected) ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white';
    $classes = $classesIfSelected.' px-3 py-2 rounded-md font-medium '.$classesIfMovile;
@endphp

@if ($isForMobileMenu)
    <a href="{{ $link }}" class="{{ $classes }}">{{ $slot }}</a>
@else
    <a href="{{ $link }}" class="{{ $classes }}">{{ $slot }}</a>
@endif
