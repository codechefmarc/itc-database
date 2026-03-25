<x-layout>
  <x-slot:heading>
    Style Guide
  </x-slot:heading>

  <x-ui.details title="Colors">

  @php
    $colors = [
      'Primary' => [
        'cobalt'   => 'Primary actions, links',
        'crimson' => 'Delete, errors',
        'charcoal' => 'Body typography',
        'slate'   => 'Borders, disabled'
        ,
      ],
      'Secondary' => [
        'olive'    => 'Success',
        'amber'    => 'Warnings',
        'navy'    => 'Accent, status',
        'plum'     => 'Accent, status',
        'teal'     => 'Accent, status',
      ],
    ];

    $shades = [50, 100, 200, 300, 400, 500, 600, 700, 800, 900];
  @endphp

  @foreach($colors as $section => $swatches)
    <h3>{{ $section }}</h3>
    @foreach($swatches as $name => $description)
      <div class="mb-4">
        <p class="text-sm font-medium text-charcoal-600 mb-1">{{ $name }} — {{ $description }}</p>
        <div class="flex gap-1">
          @foreach($shades as $shade)
            <div class="bg-{{ $name }}-{{ $shade }} w-10 h-10 rounded flex justify-center items-center" title="{{ $name }}-{{ $shade }}">
              @if($shade === 600)
                <i class="text-slate-100 fa-solid fa-check"></i>
              @endif
            </div>
          @endforeach
        </div>
      </div>
    @endforeach
  @endforeach
</x-ui.details>

  <x-ui.heading>Buttons</x-ui.heading>

  <x-ui.button>Save</x-ui.button>
  <x-ui.button variant="secondary">Cancel</x-ui.button>
  <x-ui.button variant="danger">Delete</x-ui.button>
  <x-ui.button variant="ghost">View details</x-ui.button>
  <x-ui.button size="sm">Small</x-ui.button>
  <x-ui.button disabled>Disabled</x-ui.button>



</x-layout>
