@props(['center' => false, 'nowrap' => false])

<td {{ $attributes->merge(['class' =>
    'px-6 py-4 text-sm text-charcoal-800 ' .
    ($nowrap ? 'whitespace-nowrap' : '') . ' ' .
    ($center ? 'text-center' : '')
]) }}>
    {{ $slot }}
</td>
