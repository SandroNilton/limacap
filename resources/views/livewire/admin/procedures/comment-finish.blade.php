<div>
  <div class="flex justify-between mb-5">
    <h4 class="text-opacity-100 text-[rgb(17,24,39)] font-semibold">Comentarios de cambios de estado</h4>
    <a wire:click="$refresh" class="flex items-center gap-2 cursor-pointer transition hover:text-[#10B981] ease-in-out duration-300 text-lg text-[rgb(17,24,39)] font-medium">
      <x-wire-loading class="w-8 h-8"/>
      <ion-icon name="refresh-outline" wire:ignore></ion-icon>
    </a>
  </div>
  <div class="overflow-y-scroll scrollbar max-h-80 scroll">
    @forelse ($comments_finish as $comment)
      <div class="relative flex pb-2 overflow-hidden gap-x-4">
        <div wire:ignore class="mt-0.5 relative h-full">
          <ion-icon name="time-outline" class="text-lg p-1 rounded-full bg-[#10B981] text-white"></ion-icon>
        </div>
        <p class="px-1 py-1 text-sm">
          <span class="text-[#10B981] font-medium">{{ $comment->created_at->format('d/m/Y h:i a') }}: </span><span class="text-[rgb(17,24,39)] text-opacity-100">{{ $comment->description }}</span>
        </p>
      </div>
    @empty
      <div class="w-full border border-dashed border-gray-300 rounded-[3px] flex py-1.5 justify-center text-sm">
        No hay registros
      </div>
    @endforelse
  </div>


  <div class="border border-[#cdd5de] bg-white mb-4 rounded-[3px]">
    <div class="w-full flex justify-between items-center py-2 px-2.5 border-b border-[#cdd5de]">
      <span class="text-[13px] leading-4 text-[#414d6a]">Respuestas de trámite:</span>
    </div>
    <div class="w-full p-[12px]">
      <li class="flex overflow-hidden gap-x-3">
        <p class="text-[13px] leading-4 text-[#414d6a]">
          <div class="overflow-y-scroll scrollbar h-auto max-h-72 rounded-[3px]">
            @forelse ($procedure_message_finish as $procedure_message)
            <div class="relative flex pb-2 overflow-hidden gap-x-4">
              <div wire:ignore class="mt-0.5 relative h-full">
                <div class="absolute top-5 bottom-0 left-2 w-px h-32 -ml-px border-r border-dashed border-[#cdd5de]"></div>
                <ion-icon name="time-outline"></ion-icon>
              </div>
              <p class="py-1 px-1 text-[13px] leading-4 text-[#414d6a] font-medium ">
                <span>{{ $procedure_message->created_at->format('d/m/Y h:i') }} - </span> {{ $procedure_message->description }}
              </p>
            </div>
            @empty
              --
            @endforelse
          </div>
        </p>
      </li>
    </div>
  </div>
</div>
