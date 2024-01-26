@aware(['component'])
@props(['column', 'index'])

@php
    $attributes = $attributes->merge(['wire:key' => 'header-col-'.$index.'-'.$component->id]);
    $theme = $component->getTheme();
    $customAttributes = $component->getThAttributes($column);
    $customSortButtonAttributes = $component->getThSortButtonAttributes($column);
    $direction = $column->hasField() ? $component->getSort($column->getColumnSelectName()) : null;
@endphp

@if ($theme === 'tailwind')
    <th scope="col" {{
        $attributes->merge($customAttributes)
            ->class(['px-6 py-2 text-left text-white bg-[#4373C6] text-opacity-100 text-sm tracking-wider font-normal' => $customAttributes['default'] ?? true])
            ->class(['hidden sm:table-cell' => $column->shouldCollapseOnMobile()])
            ->class(['hidden md:table-cell' => $column->shouldCollapseOnTablet()])
            ->except('default')
    }}>
        @unless ($component->sortingIsEnabled() && $column->isSortable())
            {{ $column->getTitle() }}
        @else
            <button
                wire:click="sortBy('{{ $column->getColumnSelectName() }}')"
                {{
                    $attributes->merge($customSortButtonAttributes)
                        ->class(['flex items-center space-x-1 text-left text-[rgb(17,24,39)] text-opacity-100 text-sm tracking-wider group focus:outline-none' => $customSortButtonAttributes['default'] ?? true])
                        ->except(['default', 'wire:key'])
                }}
            >
                <span>{{ $column->getTitle() }}</span>

                <span class="relative flex items-center">
                    @if ($direction === 'asc')
                        <svg class="w-3 h-3 group-hover:opacity-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path>
                        </svg>

                        <svg class="absolute w-3 h-3 opacity-0 group-hover:opacity-100" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    @elseif ($direction === 'desc')
                        <svg class="absolute w-3 h-3 opacity-0 group-hover:opacity-100" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>

                        <svg class="w-3 h-3 group-hover:opacity-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    @else
                        <svg class="w-3 h-3 transition-opacity duration-300 opacity-0 group-hover:opacity-100" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path>
                        </svg>
                    @endif
                </span>
            </button>
        @endunless
    </th>
@elseif ($theme === 'bootstrap-4' || $theme === 'bootstrap-5')
    <th scope="col" {{
        $attributes->merge($customAttributes)
            ->class(['' => $customAttributes['default'] ?? true])
            ->class(['d-none d-sm-table-cell' => $column->shouldCollapseOnMobile()])
            ->class(['d-none d-md-table-cell' => $column->shouldCollapseOnTablet()])
            ->except('default')
    }}>
        @unless ($component->sortingIsEnabled() && $column->isSortable())
            {{ $column->getTitle() }}
        @else
            <div
                class="d-flex align-items-center"
                wire:click="sortBy('{{ $column->getColumnSelectName() }}')"
                style="cursor:pointer;"
            >
                <span>{{ $column->getTitle() }}</span>

                <span class="relative d-flex align-items-center">
                    @if ($direction === 'asc')
                        <svg xmlns="http://www.w3.org/2000/svg" class="ml-1" style="width:1em;height:1em;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
                        </svg>
                    @elseif ($direction === 'desc')
                        <svg xmlns="http://www.w3.org/2000/svg" class="ml-1" style="width:1em;height:1em;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    @else
                        <svg xmlns="http://www.w3.org/2000/svg" class="ml-1" style="width:1em;height:1em;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4" />
                        </svg>
                    @endif
                </span>
            </div>
        @endunless
    </th>
@endif
