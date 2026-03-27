@props(['activities', 'title' => 'Activities'])

<x-ui.table title="{{ $title }}" :count="$activities->total()" :paginator="$activities" class="m-8">

    <x-slot:actions>
        @if($activities->count() > 0)
            <div class="text-right">
                <x-ui.link type="button" href="{{ route('checkouts.export.activities', request()->query()) }}">
                    📊 Export CSV
                </x-ui-link>
            </div>
        @endif
    </x-slot:actions>

    <table class="min-w-full divide-y divide-slate-200">
        <x-ui.table.head>
            <x-ui.table.th>Date</x-ui.table.th>
            <x-ui.table.th>Device</x-ui.table.th>
            <x-ui.table.th>Status</x-ui.table.th>
            <x-ui.table.th>User</x-ui.table.th>
            <x-ui.table.th>Notes</x-ui.table.th>
            <x-ui.table.th center>Operations</x-ui.table.th>
        </x-ui.table.head>

        <x-ui.table.body>
            @forelse($activities as $activity)
                <x-ui.table.tr>
                    <x-ui.table.td>
                        <div>{{ $activity->created_at->format('m/d/Y') }}</div>
                        <div class="text-xs text-charcoal-400">{{ $activity->created_at->format('g:iA') }}</div>
                    </x-ui.table.td>
                    <x-ui.table.td :nowrap="true">
                      <div class="text-sm font-medium text-charcoal-900">SRJC: {{ $activity->device->srjc_tag }}</div>
                      <div class="text-xs text-charcoal-500">{{ $activity->device->serial_number ? 'SN: ' . $activity->device->serial_number : '' }}</div>
                      <div class="text-xs text-charcoal-500">{{ $activity->device->computerModel->getFullNameAttribute() }}</div>
                      @if($activity->device->pool && $activity->device->pool->id !== 1)
                        <div class="text-xs text-plum-500">{{ $activity->device->pool->name }}</div>
                      @endif
                    </x-ui.table.td>
                    <x-ui.table.td :nowrap="true">
                      <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full {{ $activity->status->tailwind_class }} text-neutral-50">
                        {{ $activity->status->status_name }}
                      </span>
                    </x-ui.table.td>
                    <x-ui.table.td :nowrap="true">
                      {{ $activity->user?->full_name }}
                    </x-ui.table.td>
                    <x-ui.table.td>
                      <div class="text-sm text-charcoal-900">{{ $activity->notes }}</div>
                    </x-ui.table.td>
                    <x-ui.table.td>
                      <div class="flex gap-1 justify-around">
                        @auth
                          @if(auth()->user()->can('laptops.edit'))
                            <div class="text-center text-sm text-gray-900">
                              <a class="text-cobalt-500 text-lg font-semibold hover:text-gray-800" title="Edit activity" href="{{ route('checkouts.activities.edit', $activity->id) }}"><i class="fa-solid fa-pen-to-square"></i></a>
                            </div>
                          @endif
                          @if(auth()->user()->can('laptops.admin'))
                            <div class="text-center text-sm text-gray-900">
                              <a class="text-cobalt-500 text-lg font-semibold hover:text-gray-800" title="Edit device" href="{{ route('checkouts.devices.edit', $activity->device->id) }}"><i class="fa-solid fa-laptop-file"></i></a>
                            </div>
                          @endif
                        @endauth
                        <div class="text-center text-sm text-gray-900">
                          <a class="text-cobalt-500 text-lg font-semibold hover:text-gray-800" title="Show all activity for this device" href="{{ route('checkouts.search', ['srjc_tag' => $activity->device->srjc_tag, 'serial_number' => $activity->device->serial_number, 'status_id' => 'any', 'current_status_only' => 'off']) }}"><i class="fa-solid fa-magnifying-glass"></i></a>
                        </div>
                      </div>
                    </x-ui.table.td>
                </x-ui.table.tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center py-8 text-charcoal-400">No activities found</td>
                </tr>
            @endforelse
        </x-ui.table.body>

    </table>

</x-ui.table>
