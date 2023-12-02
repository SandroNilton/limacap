@aware(['component'])

@php
    $theme = $component->getTheme();
@endphp

@if ($theme === 'tailwind')
    <th scope="col" {{ $attributes->merge(['class' => 'table-cell items-center px-4 pt-1.5 align-middle text-center md:text-center dark:bg-gray-800']) }}>{{ $slot }}</th>
@elseif ($theme === 'bootstrap-4' || $theme === 'bootstrap-5')
    <th scope="col">{{ $slot }}</th>
@endif
