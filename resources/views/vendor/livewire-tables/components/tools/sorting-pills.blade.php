@aware(['component'])

@php
    $theme = $component->getTheme();
@endphp

@if ($theme === 'tailwind')
    <div>
        @if ($component->sortingPillsAreEnabled() && $component->hasSorts())
            <div class="px-4 mb-4 md:p-0">
                <small class="text-[rgb(17,24,39)] mr-1 text-sm">@lang('Clasificación aplicada'):</small>

                @foreach($component->getSorts() as $columnSelectName => $direction)
                    @php
                        $column = $component->getColumnBySelectName($columnSelectName);
                    @endphp

                    @continue(is_null($column))
                    @continue($column->isHidden())
                    @continue($this->columnSelectIsEnabled() && ! $this->columnSelectIsEnabledForColumn($column))

                    <span
                        wire:key="sorting-pill-{{ $columnSelectName }}"
                        class="inline-flex items-center px-2 py-1 mr-1 rounded-md text-xs font-medium bg-[#10B981] text-white capitalize"
                    >
                        {{ $column->getSortingPillTitle() }}: {{ $column->getSortingPillDirection($component, $direction) }}

                        <button
                            wire:click="clearSort('{{ $columnSelectName }}')"
                            type="button"
                            class="inline-flex items-center justify-center flex-shrink-0 w-4 h-4 ml-1.5 text-white rounded-full"
                        >
                            <span class="sr-only">@lang('Remove sort option')</span>
                            <svg class="w-2 h-2" stroke="currentColor" fill="none" viewBox="0 0 8 8">
                                <path stroke-linecap="round" stroke-width="1.5" d="M1 1l6 6m0-6L1 7" />
                            </svg>
                        </button>
                    </span>
                @endforeach

                <button
                    wire:click.prevent="clearSorts"
                    class="focus:outline-none active:outline-none"
                >
                    <span class="inline-flex items-center px-2 py-1 rounded-md text-xs font-medium bg-gray-100 text-[rgb(17,24,39)] text-opacity-100">
                        @lang('Limpiar')
                    </span>
                </button>
            </div>
        @endif
    </div>
@elseif ($theme === 'bootstrap-4')
    <div>
        @if ($component->sortingPillsAreEnabled() && $component->hasSorts())
            <div class="mb-3">
                <small>@lang('Applied Sorting'):</small>

                @foreach($component->getSorts() as $columnSelectName => $direction)
                    @php
                        $column = $component->getColumnBySelectName($columnSelectName);
                    @endphp

                    @continue(is_null($column))
                    @continue($column->isHidden())
                    @continue($this->columnSelectIsEnabled() && ! $this->columnSelectIsEnabledForColumn($column))

                    <span
                        wire:key="sorting-pill-{{ $columnSelectName }}"
                        class="badge badge-pill badge-info d-inline-flex align-items-center"
                    >
                        {{ $column->getSortingPillTitle() }}: {{ $column->getSortingPillDirection($component, $direction) }}

                        <a
                            href="#"
                            wire:click="clearSort('{{ $columnSelectName }}')"
                            class="ml-2 text-white"
                        >
                            <span class="sr-only">@lang('Remove sort option')</span>
                            <svg style="width:.5em;height:.5em" stroke="currentColor" fill="none" viewBox="0 0 8 8">
                                <path stroke-linecap="round" stroke-width="1.5" d="M1 1l6 6m0-6L1 7" />
                            </svg>
                        </a>
                    </span>
                @endforeach

                <a
                    href="#"
                    wire:click.prevent="clearSorts"
                    class="badge badge-pill badge-light"
                >
                    @lang('Clear')
                </a>
            </div>
        @endif
    </div>
@elseif ($theme === 'bootstrap-5')
    <div>
        @if ($component->sortingPillsAreEnabled() && $component->hasSorts())
            <div class="mb-3">
                <small>@lang('Applied Sorting'):</small>

                @foreach($component->getSorts() as $columnSelectName => $direction)
                    @php
                        $column = $component->getColumnBySelectName($columnSelectName);
                    @endphp

                    @continue(is_null($column))
                    @continue($column->isHidden())
                    @continue($this->columnSelectIsEnabled() && ! $this->columnSelectIsEnabledForColumn($column))

                    <span
                        wire:key="sorting-pill-{{ $columnSelectName }}"
                        class="badge rounded-pill bg-info d-inline-flex align-items-center"
                    >
                        {{ $column->getSortingPillTitle() }}: {{ $column->getSortingPillDirection($component, $direction) }}

                        <a
                            href="#"
                            wire:click="clearSort('{{ $columnSelectName }}')"
                            class="text-white ms-2"
                        >
                            <span class="visually-hidden">@lang('Remove sort option')</span>
                            <svg style="width:.5em;height:.5em" stroke="currentColor" fill="none" viewBox="0 0 8 8">
                                <path stroke-linecap="round" stroke-width="1.5" d="M1 1l6 6m0-6L1 7" />
                            </svg>
                        </a>
                    </span>
                @endforeach

                <a
                    href="#"
                    wire:click.prevent="clearSorts"
                    class="badge rounded-pill bg-light text-dark text-decoration-none"
                >
                    @lang('Clear')
                </a>
            </div>
        @endif
    </div>
@endif
