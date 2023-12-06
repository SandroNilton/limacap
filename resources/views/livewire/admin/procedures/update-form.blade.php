<div>
  <div class="flex justify-between mb-5">
    <h4 class="text-opacity-100 text-[rgb(17,24,39)] font-semibold">Estado</h4>
    <a wire:click="$refresh" class="flex items-center gap-2 cursor-pointer transition hover:text-[#10B981] ease-in-out duration-300 text-lg text-[rgb(17,24,39)] font-medium">
      <x-wire-loading class="w-8 h-8"/>
      <ion-icon name="refresh-outline" wire:ignore></ion-icon>
    </a>
  </div>
  <form wire:submit.prevent="assignState" enctype="multipart/form-data">
    <x-select wire:model="state" class="mb-3">
      <option value="">Seleccione el area</option>
      <option value="2" @if( $procedure->state == 2) @selected(true) @else @selected(false) @endif>Observado</option>
      <option value="3" @if( $procedure->state == 3) @selected(true) @else @selected(false) @endif>Revisado</option>
      @if ($files_out->count() > 0)
      @else
        <option value="4" @if( $procedure->state == 4) @selected(true) @else @selected(false) @endif>Aprobado</option>
      @endif
      <option value="5" @if( $procedure->state == 5) @selected(true) @else @selected(false) @endif>Cancelado</option>
    </x-select>
    <x-text-area wire:model="comment" name="comment" placeholder="Comentarios" class="mb-3"></x-text-area>
    <div class="col-span-3 md:col-span-1 border border-dashed border-[#d9d9da] flex flex-row rounded-md mb-3">
      <div class="px-4 inline-flex items-center border-r border-[#d9d9da] bg-white">
        <span class="text-sm text-[rgb(17,24,39)]">Archivos</span>
      </div>
      <input type="file" multiple wire:model="files" id="file_finish" class="cursor-pointer w-full flex text-sm text-center justify-center bg-white py-1.5 px-3.5 relative m-0 flex-auto duration-300 ease-in-out file:hidden focus:outline-none">
    </div>
    <x-primary-button class="text-sm">
      Guardar
    </x-primary-button>
  </div>
</div>
