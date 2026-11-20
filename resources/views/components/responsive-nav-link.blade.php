@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full ps-3.5 pe-4 py-2.5 rounded-xl border-l-4 border-[#ff0000] text-start text-sm font-bold text-white bg-white/10 focus:outline-none transition duration-150 ease-in-out shadow-sm'
            : 'block w-full ps-3.5 pe-4 py-2.5 rounded-xl border-l-4 border-transparent text-start text-sm font-medium text-slate-300 hover:text-white hover:bg-white/5 focus:outline-none transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
