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
        <div class="flex gap-3 items-center justify-between">
          <x-secondary-button wire:click="downloadFile('{{ $file->id }}', '{{ $file->name }}', '{{ $file->file }}')">
            <ion-icon  wire:ignore name="download-outline" class="text-lg"></ion-icon>
          </x-secondary-button>
          <div class="text-sm w-52 truncate text-[rgb(17,24,39)]" title="{{ $file->name }}">{{ $file->name }}</div>
        </div>
      </div>
    @empty
      <div class="w-full border border-dashed border-gray-300 rounded-[3px] flex py-1.5 justify-center text-sm">
        No hay archivos
      </div>
    @endforelse
  </div>
</div>
