<x-ui.form-card>
  <form method="POST" action="{{ route('checkouts.log') }}">
      @csrf
      <div class="space-y-6">

          <div class="md:flex justify-between gap-4">
              <div>
                  <x-checkouts.status-select />
              </div>
              <x-ui.input
                  name="notes"
                  label="Optional Notes"
                  value="{{ old('notes') }}"
                  class="w-full"
              />
          </div>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
              <x-ui.input
                  name="srjc_tag"
                  label="SRJC Tag"
                  value="{{ old('srjc_tag') }}"
                  error="{{ $errors->first('srjc_tag') }}"
                  :autofocus="!session()->get('device_not_found')"
              />
              <x-ui.input
                  name="serial_number"
                  label="Serial Number"
                  value="{{ old('serial_number') }}"
                  error="{{ $errors->first('serial_number') }}"
              />
          </div>

      </div>

      <x-ui.form-actions>
          <x-ui.button type="submit">Log Device Activity</x-ui.button>
      </x-ui.form-actions>
  </form>
</x-ui.form-card>
