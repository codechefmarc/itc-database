@props([
    'variant' => 'primary',
    'size'    => 'md',
    'type'    => 'button',
])

@php
$variants = [
    'primary'   => 'bg-cobalt-600 text-white hover:bg-cobalt-700 focus:ring-cobalt-600',
    'secondary' => 'bg-white text-navy-600 border border-slate-600 hover:bg-slate-50 focus:ring-slate-600',
    'danger'    => 'bg-crimson-600 text-white hover:bg-crimson-700 focus:ring-crimson-600',
    'ghost'     => 'bg-transparent text-navy-600 focus:ring-navy-600',
];

$sizes = [
    'sm' => 'px-3 py-1.5 text-sm',
    'md' => 'px-4 py-2 text-sm',
    'lg' => 'px-5 py-2.5 text-base',
];
@endphp

<button
    type="{{ $type }}"
    {{ $attributes->merge(['class' =>
        'inline-flex items-center gap-2 font-medium rounded-lg transition-colors ' .
        'focus:outline-none focus:ring-2 focus:ring-offset-2 ' .
        'disabled:opacity-50 disabled:cursor-not-allowed ' .
        ($variants[$variant] ?? $variants['primary']) . ' ' .
        ($sizes[$size] ?? $sizes['md'])
    ]) }}
>
    {{ $slot }}
</button>
