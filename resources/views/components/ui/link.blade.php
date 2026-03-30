@props([
    'variant' => 'link',
    'size'    => null,
])

@php
$styles  = require resource_path('views/components/ui/shared/button-styles.php');
$isLink  = $variant === 'link';
$classes = $isLink
    ? $styles['variants']['link']
    : $styles['base'] . ' ' . ($styles['variants'][$variant] ?? $styles['variants']['primary']) . ' ' . ($size ? $styles['sizes'][$size] : $styles['sizes']['md']);
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>{{ $slot }}</a>
