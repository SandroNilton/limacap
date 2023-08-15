<div>
 <div class="flex justify-between items-center py-2.5 px-2.5 border-b border-[#cdd5de] bg-white">
    <span class="text-[#414d6a] text-xs">Mi trámite</span>
  </div>
  <div class="p-[14px] bg-[#f1f3f6] sm:flex gap-3">
    <div class="w-full md:w-1/2 lg:w-1/4 mb-4">
      <!-- Info procedure -->
      <div class="border border-[#cdd5de] bg-white mb-4 rounded-[3px]">
        <div class="w-full flex justify-between items-center py-2 px-2.5 border-b border-[#cdd5de]">
          <span class="text-[13px] text-[#414d6a] leading-4">Parametros de trámite:</span>
        </div>
        <div class="w-full p-[12px]">
          <ul class="flex flex-col text-left gap-2.5">
            <li class="flex gap-x-3 overflow-hidden">
              <p class="text-[13px] leading-4 text-[#414d6a]">
                <span>Fecha de creación:</span>
                <span>{{ $procedure_data[0]->created_at->format('d/m/Y h:i') }}</span>
              <p>
            </li>
            <li class="flex gap-x-3 overflow-hidden">
              <p class="text-[13px] leading-4 text-[#414d6a]">
                <span>Tipo de trámite:</span>
                <span>{{ $procedure_data[0]->typeprocedure->name }}</span>
              </p>
            </li>
            <li class="flex gap-x-3 overflow-hidden">
              <p class="text-[13px] leading-4 text-[#414d6a]">
                <span>Área:</span>
                <span>{{ $procedure_data[0]->area->name }}</span>
              </p>
            </li>
            <li class="flex gap-x-3 overflow-hidden">
              <p class="text-[13px] leading-4 text-[#414d6a]">
                <span>Tipo de usuario:</span>
                <span>@switch($procedure_data[0]->user->type) @case(1) Natural @break @case(2) Juridica  @break @case(3) Agremiado @break @case(10)  Administrativo @break @endswitch</span>
              </p>
            </li>
            <li class="flex gap-x-3 overflow-hidden">
              <p class="text-[13px] leading-4 text-[#414d6a]">
                <span>Nombre:</span>
                <span>{{ $procedure_data[0]->user->name }}</span>
              </p>
            </li>
            <li class="flex gap-x-3 overflow-hidden">
              <p class="text-[13px] leading-4 text-[#414d6a]">
                <span>Descripción:</span>
                <span>@if (!empty($procedure_data[0]->description)) {{ $procedure_data[0]->description }} @else --  @endif</span>
              </p>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="w-full md:w-1/2 lg:w-1/4 mb-4">
      <div class="border border-[#cdd5de] bg-white mb-4 rounded-[3px]">
        <div class="w-full flex justify-between items-center py-2 px-2.5 border-b border-[#cdd5de]">
            <span class="text-[13px] leading-4 text-[#414d6a]">Archivos subidos:</span>
        </div>
        <div class="w-full p-[12px]">
          <div class="flex flex-col columns-1 grid-cols-1 text-sm gap-x-3">
            @forelse ($procedure_files as $procedure_file)
              <div class="min-w-full border border-dashed border-[#cdd5de] rounded-[3px]">
                <div class="rounded-sm flex flex-1 items-center p-2 gap-x-3">
                  <button wire:click="downloadFile('{{ $procedure_file->id }}', '{{ $procedure_file->name }}', '{{ $procedure_file->file }}')" class="flex justify-center items-center rounded-[3px] w-8 h-[51px] bg-[#0d8a72] text-white text-[18px] cursor-pointer">
                    <ion-icon  wire:ignore name="download-outline"></ion-icon>
                  </button>
                  <div class="flex-1">
                    <div class="text-[13px] w-44 truncate leading-5 text-[#414d6a]" title="{{ $procedure_file->name }}">{{ $procedure_file->name }}</div>
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
      </div>


    </div>
    @if ($procedure_data[0]->state == "aprobado")
      <div class="w-full md:w-1/2 lg:w-1/4 mb-4">
        <div class="border border-[#cdd5de] bg-white mb-4 rounded-[3px]">
          <div class="w-full flex justify-between items-center py-2 px-2.5 border-b border-[#cdd5de]">
            <span class="text-[13px] leading-4 text-[#414d6a]">Finalizacion de trámite:</span>
          </div>
          <div class="w-full p-[12px]">
            <li class="flex gap-x-3 overflow-hidden">
              <p class="text-[13px] leading-4 text-[#414d6a]">
                <span>Mensaje:</span>
                <span>
                  @if (!empty($procedure_message_finish[0]->description))
                    {{ $procedure_message_finish[0]->description }}
                  @else
                    --
                  @endif
                </span>
              </p>
            </li>
          </div>
        </div>
        <div class="border border-[#cdd5de] bg-white mb-4 rounded-[3px]">
          <div class="w-full flex justify-between items-center py-2 px-2.5 border-b border-[#cdd5de]">
              <span class="text-[13px] leading-4 text-[#414d6a]">Archivos de  finalización:</span>
          </div>
          <div class="w-full p-[12px]">
            <div class="flex flex-col columns-1 grid-cols-1 text-sm gap-x-3">
              @forelse ($procedure_files_finish as $procedure_file_finish)
                <div class="min-w-full border border-dashed border-[#cdd5de] rounded-[3px]">
                  <div class="rounded-sm flex flex-1 items-center p-2 gap-x-3">
                    <button wire:click="downloadFile('{{ $procedure_file_finish->id }}', '{{ $procedure_file_finish->name }}', '{{ $procedure_file_finish->file }}')" class="flex justify-center items-center rounded-[3px] w-8 h-[51px] bg-[#0d8a72] text-white text-[18px] cursor-pointer">
                      <ion-icon  wire:ignore name="download-outline"></ion-icon>
                    </button>
                    <div class="flex-1">
                      <div class="text-[13px] w-44 truncate leading-5 text-[#414d6a]" title="{{ $procedure_file_finish->name }}">{{ $procedure_file_finish->name }}</div>
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
        </div>
      </div>
    @endif
  </div>
<div>


