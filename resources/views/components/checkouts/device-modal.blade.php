@if(session('device_not_found') || (old('creating_device') && $errors->any()))
  <div style="position: fixed; top: 0; left: 0; right: 0; bottom: 0; background-color: rgba(0, 0, 0, 0.5); z-index: 9999; display: flex; align-items: center; justify-content: center; padding: 1rem;">
    <div class="bg-white rounded-lg shadow-xl max-w-md w-full max-h-[90vh] overflow-y-auto">
      <div class="px-6 py-4 border-b border-gray-200">
        <x-ui.heading type="h3">New Device Details</x-ui.heading>
        <p class="text-sm text-gray-600 mt-1">This device doesn't exist yet. Please provide additional details.</p>
      </div>
      <form method="POST" action="{{ route('checkouts.log') }}">
        @csrf
        {{-- Hidden fields for activity data --}}
        <input type="hidden" name="return_url" value="{{ old('return_url', request('return_url', route('checkouts.log'))) }}" />
        <input type="hidden" name="creating_device" value="1">
        <input type="hidden" name="status_id" value="{{ old('status_id') }}" />
        <input type="hidden" name="notes" value="{{ old('notes') }}" />
        <input type="hidden" name="username" value="{{ old('username') }}" />

        <div class="px-6 py-4 space-y-4">
          <x-ui.input
            type="text"
            label="SRJC Tag"
            id="srjc_tag"
            name="srjc_tag"
            value="{{ session('device_data.srjc_tag') ?: old('srjc_tag') }}"
          >
          </x-ui.input>

          <x-ui.input
            type="text"
            label="Serial Number"
            id="serial_number"
            name="serial_number"
            :autofocus="session('device_not_found') && !old('serial_number')"
            required
            value="{{ session('device_data.serial_number') ?: old('serial_number') }}"
          >
          </x-ui.input>

          <x-checkouts.model-select
            :selected="old('computer_model_id')"
            name="computer_model_id"
            required
          />
          @error('computer_model_id')
            <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
          @enderror

          <x-checkouts.pool-select :selected="old('pool_id', 1)"/>
            @error('pool_id')
              <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
            @enderror
        </div>
        <x-ui.button-group
          class="justify-end"
        >
          <x-ui.link
            variant="secondary"
            href="{{ session('device_return_url', route('checkouts.log')) }}"
          >
          Cancel
          </x-ui.link>

          <x-ui.button>Create Device & Log Activity</x-ui.button>
          </x-ui.button-group>

      </form>
    </div>
  </div>
  <script>
    document.body.style.overflow = 'hidden';
    document.addEventListener('keydown', function(e) {
      if (e.key === 'Escape') {
        window.location.href = "{{ session('device_return_url', route('checkouts.log')) }}";
      }
    });
  </script>
@endif
