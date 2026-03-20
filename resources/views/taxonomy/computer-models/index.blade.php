<x-layout>
<x-slot:heading>
  Computer Models
</x-slot:heading>

<div class="bg-white shadow-lg rounded-lg overflow-hidden">
  <div class="bg-gray-50 px-6 py-4 border-b border-gray-200 flex items-center justify-between">
    <h2 class="text-xl font-semibold text-gray-800">Computer Models ({{ $models->total() }})</h2>
    <a href="{{ route('computer-models.create') }}" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500">
      + Add Model
    </a>
  </div>

  <div class="overflow-x-auto">
    <table class="min-w-full divide-y divide-gray-200">
      <thead class="bg-gray-50">
        <tr>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Manufacturer</th>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Model Name</th>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Release Year</th>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Purchase Date</th>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Age</th>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Devices</th>
          <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Operations</th>
        </tr>
      </thead>
      <tbody class="bg-white divide-y divide-gray-200">
        @forelse($models as $model)
          <tr class="odd:bg-white even:bg-gray-50 hover:bg-gray-50 transition-colors duration-200">
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $model->manufacturer }}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $model->model_name }}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
              {{ $model->release_year ?? '—' }}
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
              {{ $model->purchase_date ? $model->purchase_date->format('m/d/Y') : '—' }}
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
              @if($model->age_in_years !== null)
                <span class="{{ $model->age_in_years >= 5 ? 'text-red-500 font-semibold' : 'text-gray-900' }}">
                  {{ $model->age_formatted }}
                </span>
              @else
                —
              @endif
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
              {{ $model->devices_count }}
            </td>
            <td class="px-6 py-4 flex gap-3 justify-center">
              <a class="text-blue-500 text-lg hover:text-gray-800" title="Edit model" href="{{ route('computer-models.edit', $model->id) }}">
                <i class="fa-solid fa-pen-to-square"></i>
              </a>
              <a class="text-blue-500 text-lg hover:text-gray-800" title="Edit model" href="{{ route('search', [ 'computer_model_id' => $model->id, 'current_status_only' => 'on', 'status_id' => 'not_surplus']) }}">
                <i class="fa-solid fa-magnifying-glass"></i>
              </a>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="7" class="text-center py-8 text-gray-500">No computer models found.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  @if($models->hasPages())
    <div class="bg-gray-50 px-6 py-3 border-t border-gray-200">
      {{ $models->links() }}
    </div>
  @endif
</div>

</x-layout>
