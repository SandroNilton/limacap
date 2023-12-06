<div>
  <div class="flex justify-between mb-5">
    <h4 class="text-opacity-100 text-[rgb(17,24,39)] font-semibold">Historial</h4>
    <a wire:click="$refresh" class="flex items-center gap-2 cursor-pointer transition hover:text-[#10B981] ease-in-out duration-300 text-lg text-[rgb(17,24,39)] font-medium">
      <x-wire-loading class="w-8 h-8"/>
      <ion-icon name="refresh-outline" wire:ignore></ion-icon>
    </a>
  </div>
  <div class="overflow-y-scroll scrollbar max-h-80 scroll">
    @forelse ($records as $record)
      <div class="relative flex pb-2 overflow-hidden gap-x-4">
        <div wire:ignore class="mt-0.5 relative h-full">
          <ion-icon name="time-outline" class="text-lg p-1 rounded-full bg-[#10B981] text-white"></ion-icon>
        </div>
        <p class="py-1 px-1 text-sm">
          <span class="text-[#10B981] font-medium">{{ $record->created_at->format('d/m/Y h:i a') }}: </span><span class="text-[rgb(17,24,39)] text-opacity-100">{{ $record->action }}</span>
        </p>
      </div>
    @empty
      <div class="w-full border border-dashed border-gray-300 rounded-[3px] flex py-1.5 justify-center text-sm">
        No hay registros
      </div>
    @endforelse
  </div>
</div>