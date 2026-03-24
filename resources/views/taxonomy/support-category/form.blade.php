<x-layout>
  <x-slot:heading>
    {{ isset($supportCategory) ? 'Edit Support Category' : 'Create Support Category' }}
  </x-slot:heading>

  <form method="POST" action="{{ isset($supportCategory) ? route('taxonomy.support_category.update', $supportCategory) : route('taxonomy.support_category.store') }}">
    @csrf
    @if(isset($supportCategory))
      @method('PUT')
    @endif

    <input type="hidden" name="return_url" value="{{ $returnUrl ?? '' }}">
    <input type="hidden" name="tailwind_class" value="bg-slate-500">

    <div class="max-w-2xl border-b border-gray-900/10 mx-auto bg-white p-8 rounded-lg shadow-md">
      <div class="pb-12">
        <div class="mt-10 flex flex-col gap-y-2">

          <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Name</label>
            <div class="mt-2">
              <div class="flex items-center gap-4">
                <input type="text"
                  name="name"
                  id="name"
                  value="{{ old('name', $supportCategory->name ?? '') }}"
                  class="border border-gray-300 rounded-lg px-3 py-1.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 w-48"
                  autofocus="autofocus"
                />
              </div>
              @error('name')
                <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
              @enderror
            </div>
          </div>

          <div class="mt-6">
            <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
            <div class="mt-2">
              <textarea name="description" id="description" rows="3" class="border border-gray-300 rounded-lg px-3 py-1.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 w-full">{{ old('description', $supportCategory->description ?? '') }}</textarea>
              @error('description')
                <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
              @enderror
            </div>
          </div>

          <div>
            <label for="weight" class="block text-sm font-medium text-gray-700 mb-2">Weight (for ordering)</label>
            <input type="number"
              id="weight"
              name="weight"
              value="{{ old('weight', $supportCategory->weight ?? 100) }}"
              class="border border-gray-300 rounded-lg px-3 py-1.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 w-48"
            />
          </div>

        </div>
      </div>

      <div class="mt-6 sm:flex max-w-2xl items-center justify-between">
        <div class="flex items-center gap-x-6 justify-self-end">
          <button type="submit" class="ml-3 rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
            {{ isset($supportCategory) ? 'Update Support Category' : 'Add Support Category' }}
          </button>
          <a href="{{ route('taxonomy.support_category.index') }}" class="text-sm/6 font-semibold text-gray-900 cursor-pointer">Cancel</a>
        </div>

        @isset($supportCategory)
        @if($supportCategory->walk_in_logs_count === 0)
          <button
            form="delete-support-category-form"
            class="text-red-500 font-bold cursor-pointer"
            onclick="return confirm('Are you sure you want to delete this support category?')"
          >Delete Support Category</button>
        @else
          <span class="text-sm text-gray-400" title="Cannot delete a model that has devices assigned to it.">
            Delete unavailable ({{ $supportCategory->walk_in_logs_count }} {{ Str::plural('walk-in', $supportCategory->walk_in_logs_count) }} assigned)
          </span>
        @endif
      @endisset

      </div>

    </div>
  </form>

@isset($supportCategory)
  <form id="delete-support-category-form" method="POST" action="{{ route('taxonomy.support_category.destroy', $supportCategory->id) }}" class="hidden">
    @csrf
    @method('DELETE')
  </form>
@endisset

</x-layout>
