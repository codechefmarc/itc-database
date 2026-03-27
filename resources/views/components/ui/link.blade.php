@props([
  'type' => 'link',
])

@php

$classes = ($type === 'button' ? 'px-3 py-1.5 text-sm text-white bg-cobalt-500 hover:bg-cobalt-800 inline-flex items-center gap-2 font-medium rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2' : 'text-cobalt-500 hover:text-cobalt-800')

@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>{{ $slot }}</a>
