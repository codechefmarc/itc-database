@props(['center' => false])

<th {{ $attributes->merge(['class' =>
    'px-6 py-3 text-xs font-medium text-charcoal-400 uppercase tracking-wider ' .
    ($center ? 'text-center' : 'text-left')
]) }}>
    {{ $slot }}
</th>
