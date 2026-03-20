<x-layout>
<x-slot:heading>
  Access Log
</x-slot:heading>

<hr class="h-px my-8 bg-gray-300 border-0">
<div class="bg-white shadow-lg rounded-lg overflow-hidden">

  <form method="GET" action="{{ route('admin.access_log') }}" class="p-6 bg-gray-50 border-b border-gray-200 flex gap-4 items-end">

    <div>
        <label class="block text-xs font-medium text-gray-500 uppercase mb-1">User</label>
        <div class="relative">
        <select name="user_id" class="appearance-none bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5 pr-8 w-full">
            <option value="">All Users</option>
            @foreach($users as $user)
                <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
                    {{ $user->full_name }}
                </option>
            @endforeach
        </select>
        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2.5 text-gray-500">
          <i class="fa-solid fa-chevron-down text-xs"></i>
        </div>
        </div>
    </div>

    <div>
        <label class="block text-xs font-medium text-gray-500 uppercase mb-1">Type</label>
        <div class="relative">
        <select name="model_type" class="appearance-none bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5 pr-8 w-full">
            <option value="">All Types</option>
            @foreach($modelTypes as $type)
                <option value="{{ $type }}" {{ request('model_type') == $type ? 'selected' : '' }}>
                    {{ $type }}
                </option>
            @endforeach
        </select>
        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2.5 text-gray-500">
          <i class="fa-solid fa-chevron-down text-xs"></i>
        </div>
        </div>
    </div>

    <button type="submit" class="appearance-none bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold py-2.5 px-4 rounded-lg transition-colors cursor-pointer">
        Filter
    </button>

    @if(request('user_id') || request('model_type'))
        <a href="{{ route('reports.access_log') }}" class="px-4 py-2 bg-gray-200 text-gray-700 text-sm rounded hover:bg-gray-300">
            Clear
        </a>
    @endif

</form>

  <div class="overflow-x-auto">
    <table class="min-w-full divide-y divide-gray-200">

      <thead class="bg-gray-50">
        <tr>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
            Date
          </th>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
            User
          </th>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
            Type
          </th>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
            Description
          </th>
        </tr>
      </thead>

      <tbody class="bg-white divide-y divide-gray-200">
        @forelse($accessLogs as $accessLog)
          <tr class="odd:bg-white even:bg-gray-50 hover:bg-gray-50 transition-colors duration-200">

            <td class="px-6 py-4 whitespace-nowrap">
              <div class="text-sm text-gray-900">{{ $accessLog->created_at->format('m/d/Y') }}</div>
              <div class="text-xs text-gray-500">{{ $accessLog->created_at->format('g:iA') }}</div>
            </td>

            <td class="px-6 py-4 whitespace-nowrap">
              <div class="text-sm font-medium text-gray-900">{{ $accessLog->user->full_name }}</div>
            </td>

            <td class="px-6 py-4 whitespace-nowrap">
              <div class="text-sm font-medium text-gray-900">{{ $accessLog->model_type }}</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
              {{ $accessLog->description }}
            </td>
          </tr>
        @empty
          <tr><td colspan="6" class="text-center py-8">No access logs found</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>

  @if ($accessLogs->hasPages())
    <div class="bg-gray-50 px-6 py-3 border-t border-gray-200">
      {{ $accessLogs->links() }}
    </div>
  @endif

</div>

<form method="POST" action="{{ route('admin.access_log.destroy') }}"
    onsubmit="return confirm('Are you sure you want to clear these logs?')"
    class="mt-3">
    @csrf
    @method('DELETE')

    <div class="flex gap-2 items-end">
        <div>
            <label class="block text-xs font-medium text-gray-500 uppercase mb-1">Clear Logs</label>
            <div class="relative">
            <select name="range" class="appearance-none bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5 pr-8 w-full">
                <option value="month">Older than 1 month</option>
                <option value="6months">Older than 6 months</option>
                <option value="all">All logs</option>
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2.5 text-gray-500">
          <i class="fa-solid fa-chevron-down text-xs"></i>
        </div>
            </div>
        </div>
        <button type="submit" class="px-4 py-2 bg-red-600 text-white text-sm rounded hover:bg-red-700">
            Clear
        </button>
    </div>
</form>


</x-layout>
