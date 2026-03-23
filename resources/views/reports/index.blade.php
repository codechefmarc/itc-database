<x-layout>
  <x-slot:heading>
    Reports
  </x-slot:heading>

<div class="md:flex justify-between max-w-2xl mx-auto bg-white p-8 rounded-lg shadow-md">
  <div>
    <h3 class="font-bold text-xl text-gray-600 mb-3">Devices</h3>
    <ul>
      <li><a class="text-blue-500" href="?report=active_devices">Active Devices</a> ({{ $active_device_count }})</li>
      <li><a class="text-blue-500" href="?report=surplus_devices">Surplus Devices</a> ({{ $surplus_device_count }})</li>
      <li><a class="text-blue-500" href="?report=inactive_devices">Devices Without Activities</a> ({{ $inactive_device_count }})</li>
      <li>
        @auth
          @if(auth()->user()->can('laptops.admin'))
            <a class="text-blue-500" href="{{ route('checkouts.flagged_devices.index') }}">
          @endif
        @endauth
        Flagged for Review / Deletion
        @auth
          @if(auth()->user()->can('laptops.admin'))
            </a>
          @endif
        @endauth
        ({{ $flagged_device_count }})
      </li>
      <li><a class="text-blue-500" href="?report=all_devices">Total Devices</a> ({{ $total_device_count }})</li>
    </ul>
    <details open>
      <summary class="cursor-pointer font-bold text-xl text-gray-600 mb-3 mt-3">
        Active Devices by Model
      </summary>
      <ul>
        @foreach($active_device_model_counts as $device)
          @php
            if ($device->computerModel == "Unknown Model") {
              $link = route('checkouts.search', [ 'show_empty_models' => 'true', 'current_status_only' => 'on', 'status_id' => 'not_surplus']);
            } else {
              $link = route('checkouts.search', [ 'computer_model_id' => $device->computerModel, 'current_status_only' => 'on', 'status_id' => 'not_surplus']);
            }
          @endphp
          <li>
            <a class="text-blue-500" href="{{ $link }}"> {{ $device->computerModel->getFullNameAttribute() }}</a> ({{ $device->device_count }})
          </li>
        @endforeach
      </ul>
    </details>

    <details>
      <summary class="cursor-pointer font-bold text-xl text-gray-600 mb-3 mt-3">
        Surplus Devices by Model
      </summary>
      <ul>
        @foreach($surplus_device_model_counts as $device)
          @php
            if ($device->computerModel == "Unknown Model") {
              $link = route('checkouts.search', [ 'show_empty_models' => 'true', 'current_status_only' => 'on', 'status_id' => $surplus_status_id]);
            } else {
              $link = route('checkouts.search', [ 'computer_model_id' => $device->computerModel, 'current_status_only' => 'on', 'status_id' => $surplus_status_id]);
            }
          @endphp
          <li>
            <a class="text-blue-500" href="{{ $link }}"> {{ $device->computerModel->getFullNameAttribute() }}</a> ({{ $device->device_count }})
          </li>
        @endforeach
      </ul>
    </details>

    <details>
      <summary class="cursor-pointer font-bold text-xl text-gray-600 mb-3 mt-3">
        Active Devices by Age
      </summary>
    <ul>
        @foreach($devices_by_age as $device)
          @php
            if ($device->model_name == "Unknown Model") {
              $link = route('checkouts.search', [ 'show_empty_models' => 'true', 'current_status_only' => 'on', 'status_id' => 'not_surplus']);
            } else {
              $link = route('checkouts.search', [ 'computer_model_id' => $device->computer_model_id, 'current_status_only' => 'on', 'status_id' => 'not_surplus']);
            }
          @endphp
          <li>
            <span class="{{ $device->age_in_years >= 5 ? 'text-red-500 font-semibold' : 'text-gray-900' }}">{{ $device->age_formatted }}</span> - <a class="text-blue-500" href="{{ $link }}">{{ $device->model_name }}</a> ({{ $device->device_count }})
          </li>
        @endforeach
      </ul>
    </details>
  </div>

  <div class="report-quick-facts">
    <h3 class="font-bold text-xl text-gray-600 mb-3">Current Activity by Status</h3>
    <ul>
    @foreach($status_counts as $status)
      <li><a class="text-blue-500" href="{{ route('checkouts.search', ['status_id' => $status->status_id, 'current_status_only' => 'on']) }}"> {{ $status->status_name }}</a> ({{ $status->device_count }})</li>
    @endforeach

    </ul>

    <h3 class="font-bold text-xl text-gray-600 mb-3 mt-3">Current Activity by Pool</h3>
    <ul>
      @foreach($pool_counts_current as $pool)
        <li>
          <a class="text-blue-500" href="{{ route('checkouts.search', ['pool_id' => $pool->pool_id, 'current_status_only' => 'on']) }}"> {{ $pool->pool_name }}</a> ({{ $pool->device_count }})
        </li>
      @endforeach
    </ul>
  </div>
</div>


  @if($activities !== null)
    <x-checkouts.activity-list :activities="$activities">
      Report Results
    </x-checkouts.activity-list>
  @endif

  @if($devices !== null)
    <x-checkouts.device-list :devices="$devices">
      {{ $report_title }}
    </x-checkouts.device-list>
  @endif

</x-layout>
