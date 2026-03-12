<x-layout>
<x-slot:heading>
  {{ isset($model) ? 'Edit Computer Model' : 'Add Computer Model' }}
</x-slot:heading>

<form method="POST" action="{{ isset($model) ? route('computer-models.patch', $model->id) : route('computer-models.store') }}">
  @csrf
  @if(isset($model))
    @method('PATCH')
  @endif

  <div class="max-w-2xl border-b border-gray-900/10 mx-auto bg-white p-8 rounded-lg shadow-md">
    <div class="pb-12">
      <div class="mt-10 flex flex-col gap-y-4">
        <h3 class="text-2xl">
          {{ isset($model) ? $model->full_name : 'Model Details' }}
        </h3>
        @isset($model)
          <p class="text-sm text-gray-500">
            Used by {{ $model->devices_count }} {{ Str::plural('device', $model->devices_count) }}
          </p>
        @endisset

        <div>
          <label for="manufacturer" class="block text-sm font-medium text-gray-700 mb-2">
            Manufacturer <span class="text-red-500 text-sm">*</span>
          </label>
          <div class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
            <input
              id="manufacturer"
              type="text"
              name="manufacturer"
              required
              value="{{ old('manufacturer', $model->manufacturer ?? '') }}"
              placeholder="e.g. Dell, Apple, Lenovo"
              class="block min-w-0 grow py-1.5 pr-3 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6" />
          </div>
          @error('manufacturer')
            <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
          @enderror
        </div>

        <div>
          <label for="model_name" class="block text-sm font-medium text-gray-700 mb-2">
            Model Name <span class="text-red-500 text-sm">*</span>
          </label>
          <div class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
            <input
              id="model_name"
              type="text"
              name="model_name"
              required
              value="{{ old('model_name', $model->model_name ?? '') }}"
              placeholder="e.g. Latitude 5420"
              class="block min-w-0 grow py-1.5 pr-3 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6" />
          </div>
          @error('model_name')
            <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
          @enderror
        </div>

        <div>
          <label for="release_year" class="block text-sm font-medium text-gray-700 mb-2">Release Year</label>
          <div class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
            <input
              id="release_year"
              type="number"
              name="release_year"
              value="{{ old('release_year', $model->release_year ?? '') }}"
              min="1990"
              max="{{ now()->year + 1 }}"
              placeholder="e.g. 2022"
              class="block min-w-0 grow py-1.5 pr-3 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6" />
          </div>
          @error('release_year')
            <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
          @enderror
        </div>

        <div>
          <label for="purchase_date" class="block text-sm font-medium text-gray-700 mb-2">Purchase Date</label>
          <div class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
            <input
              id="purchase_date"
              type="date"
              name="purchase_date"
              value="{{ old('purchase_date', isset($model) ? $model->purchase_date?->format('Y-m-d') : '') }}"
              class="block min-w-0 grow py-1.5 pr-3 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6" />
          </div>
          @error('purchase_date')
            <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
          @enderror
        </div>

      </div>
    </div>

    <div class="mt-6 flex items-center justify-between">
      <div class="flex items-center gap-x-6">
        <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
          {{ isset($model) ? 'Update' : 'Save Model' }}
        </button>
        <a href="{{ route('computer-models.index') }}" class="text-sm/6 font-semibold text-gray-900">Cancel</a>
      </div>

      @isset($model)
        @if($model->devices_count === 0)
          <button
            form="delete-model-form"
            class="text-red-500 font-bold cursor-pointer"
            onclick="return confirm('Are you sure you want to delete this model?')"
          >Delete Model</button>
        @else
          <span class="text-sm text-gray-400" title="Cannot delete a model that has devices assigned to it.">
            Delete unavailable ({{ $model->devices_count }} {{ Str::plural('device', $model->devices_count) }} assigned)
          </span>
        @endif
      @endisset
    </div>
  </div>
</form>

@isset($model)
  <form id="delete-model-form" method="POST" action="{{ route('computer-models.delete', $model->id) }}" class="hidden">
    @csrf
    @method('DELETE')
  </form>
@endisset

</x-layout>
