@aware(['component'])
@props(['rows'])

@if ($component->bulkActionsAreEnabled() && $component->hasBulkActions())
  @php
    $table = $component->getTableName();
    $theme = $component->getTheme();
    $colspan = $component->getColspanCount();
    $selectAll = $component->selectAllIsEnabled();
    $simplePagination = $component->paginationMethod == 'simple' ? true : false;
  @endphp
  @if ($theme === 'tailwind')
    <x-livewire-tables::table.tr.plain wire:key="bulk-select-message-{{ $table }}" class="bg-white" x-cloak x-show="selectedItems.length > 0">
      <x-livewire-tables::table.td.plain :colspan="$colspan">
        <template x-if="selectedItems.length == paginationTotalItemCount">
          <div wire:key="all-selected-{{ $table }}">
            <span class="text-sm text-[rgb(17,24,39)] text-opacity-100">
              @lang('Actualmente estás seleccionando todo')
              @if(!$simplePagination) <strong><span x-text="paginationTotalItemCount"></span></strong> @endif
              @lang('filas').
            </span>
            <button x-on:click="clearSelected" wire:loading.attr="disabled" type="button" class="ml-1 text-[#10B981] text-sm focus:outline-none">
              @lang('Deseleccionar todo')
            </button>
          </div>
        </template>
        <template x-if="selectedItems.length !== paginationTotalItemCount">
          <div wire:key="some-selected-{{ $table }}">
            <span class="text-sm text-[rgb(17,24,39)] text-opacity-100">
              @lang('Usted ha seleccionado')
              <strong><span x-text="selectedItems.length"></span></strong>
              @lang('filas, ¿quieres seleccionar todas?')
              @if(!$simplePagination) <strong><span x-text="paginationTotalItemCount"></span></strong> @endif
            </span>
            <button x-on:click="selectAllOnPage()" wire:loading.attr="disabled" type="button" class="ml-1 text-[#10B981] text-sm focus:outline-none">
              @lang('Seleccionar todo en la página')
            </button>&nbsp;
            <button x-on:click="setAllSelected" wire:loading.attr="disabled" type="button" class="ml-1 text-[#10B981] text-sm focus:outline-none">
              @lang('Seleccionar todo')
            </button>
            <button x-on:click="clearSelected" wire:loading.attr="disabled" type="button" class="ml-1 text-[#10B981] text-sm focus:outline-none">
              @lang('Deseleccionar todo')
            </button>
          </div>
        </template>
      </x-livewire-tables::table.td.plain>
    </x-livewire-tables::table.tr.plain>
    @elseif ($theme === 'bootstrap-4' || $theme === 'bootstrap-5')
        <x-livewire-tables::table.tr.plain
            wire:key="bulk-select-message-{{ $table }}"
            x-cloak
            x-show="selectedItems.length > 0"
        >
            <x-livewire-tables::table.td.plain :colspan="$colspan">
                <template x-if="selectedItems.length == paginationTotalItemCount">
                    <div wire:key="all-selected-{{ $table }}">
                        <span>
                            @lang('You are currently selecting all')
                            @if(!$simplePagination) <strong><span x-text="paginationTotalItemCount"></span></strong> @endif
                            @lang('rows').
                        </span>

                        <button
                            x-on:click="clearSelected"
                            wire:loading.attr="disabled"
                            type="button"
                            class="btn btn-primary btn-sm"
                        >
                            @lang('Deselect All')
                        </button>
                    </div>
                </template>
                <template x-if="selectedItems.length !== paginationTotalItemCount">
                    <div wire:key="some-selected-{{ $table }}">
                        <span>
                            @lang('You have selected')
                            <strong><span x-text="selectedItems.length"></span></strong>
                            @lang('rows, do you want to select all')
                            @if(!$simplePagination) <strong><span x-text="paginationTotalItemCount"></span></strong> @endif
                        </span>

                        <button
                            x-on:click="selectAllOnPage"
                            wire:loading.attr="disabled"
                            type="button"
                            class="btn btn-primary btn-sm"
                        >
                            @lang('Select All On Page')
                        </button>&nbsp;

                        <button
                            x-on:click="setAllSelected"
                            wire:loading.attr="disabled"
                            type="button"
                            class="btn btn-primary btn-sm"
                        >
                            @lang('Select All')
                        </button>

                        <button
                            x-on:click="clearSelected"
                            wire:loading.attr="disabled"
                            type="button"
                            class="btn btn-primary btn-sm"
                        >
                            @lang('Deselect All')
                        </button>
                    </div>
                </template>
            </x-livewire-tables::table.td.plain>
        </x-livewire-tables::table.tr.plain>
    @endif
@endif
