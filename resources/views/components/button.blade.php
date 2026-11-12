@props(['type' => 'button', 'varient' => 'primary'])

@php

    $styles = [
        'primary' => 'bg-indigo-600 text-white hover:bg-indigo-700',
        'secondary' => 'bg-slate-200 text-slate-800 hover:bg-slate-300',
        'outline' => 'border border-indigo-600 text-indigo-600 hover:bg-indigo-600 hover:text-white',
        'danger' => 'bg-rose-600 text-white hover:bg-rose-700',
        'ghost' => 'text-slate-700 hover:bg-indigo-50',
        'link' => 'text-indigo-600 underline hover:text-indigo-800',
    ];

    $bg = $styles[$varient];

@endphp

<button {{ $attributes->merge([]) }} class="{{ $bg }} cursor-pointer text-[.9em] font-medium px-3 py-1 rounded-md transition" type="{{ $type }}">
    {{ $slot }}
</button>
