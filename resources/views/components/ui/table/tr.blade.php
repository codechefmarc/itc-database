<tr {{ $attributes->merge(['class' => 'odd:bg-white even:bg-slate-50 hover:bg-slate-100 transition-colors duration-150']) }}>
    {{ $slot }}
</tr>
