@props([
    'type' => 'h2',
])

@php
$styles = [
    'h1' => 'lg:text-3xl md:text-2xl sm:text-xl',
    'h2' => 'lg:text-2xl md:text-1xl sm:text-md',
    'h3' => 'lg:text-xl md:text-md sm:text-base',
    'h4' => 'lg:text-xl md:text-base',
    'h5' => 'text-base',
    'h6' => 'text-base',
];

$classes = $styles[$type] . ' font-semibold text-charcoal-800';
@endphp

@switch($type)
    @case('h1')
        <h1 {{ $attributes->merge(['class' => $classes]) }}>{{ $slot }}</h1>
        @break
    @case('h3')
        <h3 {{ $attributes->merge(['class' => $classes]) }}>{{ $slot }}</h3>
        @break
    @case('h4')
        <h4 {{ $attributes->merge(['class' => $classes]) }}>{{ $slot }}</h4>
        @break
    @case('h5')
        <h5 {{ $attributes->merge(['class' => $classes]) }}>{{ $slot }}</h5>
        @break
    @case('h6')
        <h6 {{ $attributes->merge(['class' => $classes]) }}>{{ $slot }}</h6>
        @break
    @default
        <h2 {{ $attributes->merge(['class' => $classes]) }}>{{ $slot }}</h2>
@endswitch
