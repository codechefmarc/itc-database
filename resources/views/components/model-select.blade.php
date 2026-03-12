@props([
  'selected' => null,
  'name'     => 'computer_model_id',
  'required' => false,
])

@php
  $selectedModel = null;
  if ($selected instanceof \App\Models\ComputerModel) {
    $selectedModel = $selected;
  } elseif (is_numeric($selected) && $selected) {
    $selectedModel = \App\Models\ComputerModel::find($selected);
  }
@endphp

<div>
  <label for="{{ $name }}" class="block text-sm font-medium text-gray-700 mb-2">
    Computer Model @if($required)<span class="text-red-500 text-sm">*</span>@endif
  </label>

  <select
    id="{{ $name }}"
    name="{{ $name }}"
    @if($required) required @endif
  >
    @if($selectedModel)
      <option value="{{ $selectedModel->id }}" selected>
        {{ $selectedModel->full_name }}
      </option>
    @endif
  </select>
</div>

{{-- Add New Model Modal --}}
<div id="model-create-modal" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.5); z-index: 9999; align-items: center; justify-content: center; padding: 1rem;">
  <div class="bg-white rounded-lg shadow-xl w-full max-w-md" onclick="event.stopPropagation()">
    <div class="px-6 py-4 border-b border-gray-200">
      <h3 class="text-lg font-semibold text-gray-900">Add New Computer Model</h3>
      <p class="text-sm text-gray-600 mt-1">This model doesn't exist yet. Fill in the details below.</p>
    </div>

    <div class="px-6 py-4 space-y-4">
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Manufacturer <span class="text-red-500">*</span></label>
        <input id="modal-manufacturer" type="text" placeholder="e.g. Dell, Apple, Lenovo"
          class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" />
      </div>

      <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Model Name <span class="text-red-500">*</span></label>
        <input id="modal-model-name" type="text" placeholder="e.g. Latitude 5420"
          class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" />
      </div>

      <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Release Year</label>
        <input id="modal-release-year" type="number" placeholder="e.g. 2022" min="1990" max="{{ now()->year + 1 }}"
          class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" />
      </div>

      <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Purchase Date</label>
        <input id="modal-purchase-date" type="date"
          class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" />
      </div>

      <p id="modal-error" class="text-xs text-red-500 font-semibold"></p>
    </div>

    <div class="px-6 py-4 border-t border-gray-200 flex justify-end gap-2">
      <button id="modal-close-btn" type="button"
        class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 border border-gray-300 rounded-md hover:bg-gray-200">
        Cancel
      </button>
      <button id="modal-save-btn" type="button"
        class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md hover:bg-indigo-500">
        Save Model
      </button>
    </div>
  </div>
</div>
