@props([
    'type' => 'h2',
])

<{{ $type }} {{ $attributes->merge(['class' => 'text-xl font-semibold text-gray-800']) }}>
  {{ $slot }}
</{{ $type }}>
