<x-layout>
  <x-slot:heading>
    Search
  </x-slot:heading>

  <x-search-form :statusFilterInfo="$statusFilterInfo" :poolName="$poolName" :modelName="$modelName" :selectedModel="$selectedModel" />

  @if($activities !== null)
    <x-checkouts.activity-list :activities="$activities" title="Activities" />
  @endif

  @if($devices !== null)
    <x-checkouts.device-list :devices="$devices">
      Devices ({{ $devices->total() }})
    </x-checkouts.device-list>
  @endif


</x-layout>
