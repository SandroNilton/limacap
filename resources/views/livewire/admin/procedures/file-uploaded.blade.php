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
              <div class="min-w-full border border-dashed border-[#cdd5de] rounded-[3px]">
                <div class="flex items-center flex-1 p-2 rounded-sm gap-x-3">
                  <button wire:click="downloadFile('{{ $procedure_file->id }}', '{{ $procedure_file->name }}', '{{ $procedure_file->file }}')" class="flex justify-center items-center rounded-[3px] w-8 h-[51px] bg-[#0d8a72] text-white text-[18px] cursor-pointer">
                    <ion-icon  wire:ignore name="download-outline"></ion-icon>
                  </button>
                  <div class="flex-1">
                    <div class="text-[13px] w-44 truncate leading-5 text-[#414d6a]" title="{{ $procedure_file->name }}">{{ $procedure_file->name }}</div>
                    @if ($procedure_data[0]->state == 'aprobado' || $procedure_data[0]->state == 'cancelado')
                    @else
                      <div class="flex gap-x-3">
                        <form wire:submit.prevent="changeStateFile(Object.fromEntries(new FormData($event.target)))" class="flex w-full gap-x-2.5">
                          <input type="hidden" name="procedurefile_id" value="{{ $procedure_file->id }}">
                          <select id="{{ $procedure_file->id }}" name="state_id" class="w-full py-1.5 text-[13px] leading-4 rounded-[3px] border-[#cdd5de] focus:border-[#4482ff] hover:border-[#4482ff] focus:ring-0 transition duration-300">
                            <option value="sinverificar" @if($procedure_file->state == "sinverificar") @selected(true) @else @selected(false) @endif>Sin verificar</option>
                            <option value="aceptado" @if($procedure_file->state == "aceptado") @selected(true) @else @selected(false) @endif>Aceptado</option>
                            <option value="rechazado" @if($procedure_file->state == "rechazado") @selected(true) @else @selected(false) @endif>Rechazado</option>
                          </select>
                          <button class="bg-[#0d8a72] px-1.5 rounded-[3px] text-white text-[16px] py-1 inline-flex items-center">
                            <ion-icon  wire:ignore name="refresh-outline"></ion-icon>
                          </button>
                        </form>
                      </div>
                    @endif
                  </div>
                </div>
              </div>
            @empty
              <div class="w-full border border-dashed border-[#cdd5de] rounded-[3px] flex py-1.5 justify-center text-[13px] leading-4 text-[#cdd5de]">
                No hay archivos
              </div>
            @endforelse
  </div>
</div>