@props([
    'title'      => null,
    'count'      => null,
    'paginator'  => null,
])

<div {{ $attributes->merge(['class' => 'bg-white shadow-lg border border-charcoal-100 rounded-lg overflow-hidden']) }}>

    @if($title)
        <div class="bg-slate-50 px-6 py-4 border-b border-slate-200">
            <x-ui.heading type="h3">
              {!! $title !!}{{ $count !== null ? " ({$count})" : '' }}
            </x-ui-heading>
        </div>
    @endif

    <div class="overflow-x-auto">
        {{ $slot }}
    </div>

    @if(isset($paginator) && $paginator->hasPages())
        <div class="bg-slate-50 px-6 py-3 border-t border-slate-200">
            {{ $paginator->links() }}
        </div>
    @endif

    @if(isset($actions))
        <div class="px-6 py-3 border-t border-slate-200">
            {{ $actions }}
        </div>
    @endif

</div>
