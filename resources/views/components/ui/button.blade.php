@props([
    'variant' => 'primary',
    'size'    => 'md',
    'type'    => 'button',
])

@php
$styles = require resource_path('views/components/ui/shared/button-styles.php');
$classes  = $styles['base'] . ' ' . ($styles['variants'][$variant] ?? $styles['variants']['primary']) . ' ' . ($styles['sizes'][$size] ?? $styles['sizes']['md']);
@endphp

<button
    type="{{ $type }}"
    {{ $attributes->merge(['class' => $classes]) }}
>
    {{ $slot }}
</button>
