@props(['active'])

@php
$classes = ($active ?? false)
            ? 'relative px-4 py-3 flex items-center align-middle space-x-2 rounded-xl text-white bg-gradient-to-r from-indigo-800 to-blue-600'
            : 'px-4 py-3 flex items-center align-middle space-x-2 rounded-md text-gray-600 group hover:text-indigo-800 hover:bg-gray-100 active:bg-gray-200';
@endphp

<li>
    <a {{ $attributes->merge(['class' => $classes]) }}>
        <div class="h-6 w-6 flex justify-center items-center">
            {{ $logo }}
        </div>
        <span class="font-medium text-sm">{{ $slot }}</span>
    </a>
</li>
