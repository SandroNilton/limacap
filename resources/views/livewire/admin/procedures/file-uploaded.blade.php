<div>
  <div class="flex justify-between mb-5">
    <h4 class="text-opacity-100 text-[rgb(17,24,39)] font-semibold">Archivos subidos</h4>
    <a wire:click="$refresh" class="flex items-center gap-2 cursor-pointer transition hover:text-[#10B981] ease-in-out duration-300 text-lg text-[rgb(17,24,39)] font-medium">
      <x-wire-loading class="w-8 h-8"/>
      <ion-icon name="refresh-outline" wire:ignore></ion-icon>
    </a>
  </div>
  <div>
    @forelse ($files as $file)
      <div class="items-center border border-gray-200 rounded-md p-3">
        <div class="text-sm w-52 truncate text-[rgb(17,24,39)] mb-1.5" title="{{ $file->name }}">{{ $file->name }}</div>
        <div class="grid gap-3 grid-cols-6">
          <div class="col-span-1">
            <x-secondary-button wire:click="downloadFile('{{ $file->id }}', '{{ $file->name }}', '{{ $file->file }}')">
              <ion-icon  wire:ignore name="download-outline" class="text-lg"></ion-icon>
            </x-secondary-button>
          </div>
          @if ($procedure->state == 'aprobado' || $procedure->state == 'cancelado')
          @else
            <div class="col-span-5">
              <form wire:submit.prevent="changeState(Object.fromEntries(new FormData($event.target)))" class="flex gap-3">
                <input type="hidden" name="file_id" value="{{ $file->id }}">
                <x-select id="{{ $file->id }}" name="state">
                  <option value="100" @if($file->state == "100") @selected(true) @else @selected(false) @endif>Sin verificar</option>
                  <option value="101" @if($file->state == "101") @selected(true) @else @selected(false) @endif>Aceptado</option>
                  <option value="102" @if($file->state == "102") @selected(true) @else @selected(false) @endif>Rechazado</option>
                </x-select>
                <x-primary-button>
                  <ion-icon wire:ignore name="refresh-outline" class="text-lg"></ion-icon>
                </x-primary-button>
              </form>
            </div>
          @endif
        </div>
      </div>
    @empty
      <div class="w-full border border-dashed border-gray-300 rounded-[3px] flex py-1.5 justify-center text-sm">
        No hay archivos
      </div>
    @endforelse
  </div>
</div>