@props([
    'label'   => null,
    'name'    => null,
    'id'      => null,
    'type'    => 'text',
    'error'   => null,
    'helper'  => null,
])

@php $inputId = $id ?? $name; @endphp

<div {{ $attributes->filter(fn($val, $key) => $key === 'class')->merge(['class' => '']) }}>
    @if($label)
        <label for="{{ $inputId }}" class="block text-sm font-medium text-charcoal-600 mb-1.5">
            {{ $label }}
        </label>
    @endif

    <input
        type="{{ $type }}"
        id="{{ $inputId }}"
        name="{{ $name }}"
        {{ $attributes->filter(fn($val, $key) => $key !== 'class')->merge(['class' =>
            'w-full px-3 py-2 rounded-lg border transition-colors ' .
            'focus:outline-none focus:ring-2 focus:ring-offset-0 ' .
            ($error
                ? 'border-crimson-600 focus:ring-crimson-300 focus:border-crimson-600'
                : 'border-slate-600 focus:ring-navy-300 focus:border-navy-600')
        ]) }}
    >

    @if($error)
        <p class="mt-1 text-xs font-semibold text-crimson-600">{{ $error }}</p>
    @elseif($helper)
        <p class="mt-1 text-xs text-charcoal-400">{{ $helper }}</p>
    @endif
</div>
