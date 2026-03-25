@props([
  'display' => 'open',
  'title' => 'Details'
])

<details {{ $display }}>
  <summary>
    <x-ui.heading class="inline cursor-pointer">
      {{ $title }}
    </x-ui.heading>
  </summary>
  {{  $slot }}
</details>
