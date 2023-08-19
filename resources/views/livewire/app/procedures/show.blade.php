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
      <div class="border border-[#cdd5de] bg-white mb-4 rounded-[3px]">
        <div class="w-full flex justify-between items-center py-2 px-2.5 border-b border-[#cdd5de]">
            <span class="text-[13px] leading-4 text-[#414d6a]">Archivos subidos:</span>
        </div>
        <div class="w-full p-[12px]">
          <div class="flex flex-col columns-1 grid-cols-1 text-sm gap-x-3">
            @forelse ($procedure_files as $procedure_file)
              @if($procedure_file->state == "rechazado")
                <div class="min-w-full border border-dashed border-[#cdd5de] rounded-[3px]">
                  <div class="rounded-sm flex flex-1 items-center p-2 gap-x-3">
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
              @else
                <div class="min-w-full border border-dashed border-[#cdd5de] rounded-[3px]">
                    <div class="rounded-sm flex flex-1 items-center p-2 gap-x-3">
                      <button wire:click="downloadFile('{{ $procedure_file->id }}', '{{ $procedure_file->name }}', '{{ $procedure_file->file }}')" class="flex justify-center items-center rounded-[3px] w-8 h-[51px] bg-[#0d8a72] text-white text-[18px] cursor-pointer">
                        <ion-icon  wire:ignore name="download-outline"></ion-icon>
                      </button>
                      <div class="flex-1">
                        <div class="text-[13px] w-44 truncate leading-5 text-[#414d6a]" title="{{ $procedure_file->name }}">{{ $procedure_file->name }}</div>
                        <div class="text-[13px] w-44 truncate leading-5 text-[#414d6a]" title="{{ $procedure_file->state }}">{{ $procedure_file->state }}</div>
                    </div>
                    </div>
                  </div>
              @endif

            @empty
                <div class="w-full border border-dashed border-[#cdd5de] rounded-[3px] flex py-1.5 justify-center text-[13px] leading-4 text-[#cdd5de]">
                No hay archivos
                </div>
            @endforelse
          </div>
        </div>
      </div>
    </div>
    <div class="w-full md:w-1/2 lg:w-1/4 mb-4">
        <div class="border border-[#cdd5de] bg-white mb-4 rounded-[3px]">
            <div class="w-full flex justify-between items-center py-2 px-2.5 border-b border-[#cdd5de]">
              <span class="text-[13px] leading-4 text-[#414d6a]">Respuestas de trámite:</span>
            </div>
            <div class="w-full p-[12px]">
              <li class="flex gap-x-3 overflow-hidden">
                <p class="text-[13px] leading-4 text-[#414d6a]">
                  <div class="overflow-y-scroll scrollbar h-auto max-h-72 rounded-[3px]">
                    @forelse ($procedure_message_finish as $procedure_message)
                    <div class="relative flex gap-x-4 pb-2 overflow-hidden">
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
          <div class="border border-[#cdd5de] bg-white mb-4 rounded-[3px]">
            <div class="w-full flex justify-between items-center py-2 px-2.5 border-b border-[#cdd5de]">
              <span class="text-[13px] leading-4 text-[#414d6a]">Archivos de cambios de estado:</span>
            </div>
            <div class="w-full p-[12px]">
              <div class="flex flex-col columns-1 grid-cols-1 text-sm gap-x-3">
                @forelse ($procedure_files_responses as $procedure_file_response)
                  <div class="min-w-full border border-dashed border-[#cdd5de] rounded-[3px]">
                    <div class="rounded-sm flex flex-1 items-center p-2 gap-x-3">
                      <button wire:click="downloadFile('{{ $procedure_file_response->id }}', '{{ $procedure_file_response->name }}', '{{ $procedure_file_response->file }}')" class="flex justify-center items-center rounded-[3px] w-8 h-[51px] bg-[#0d8a72] text-white text-[18px] cursor-pointer">
                        <ion-icon  wire:ignore name="download-outline"></ion-icon>
                      </button>
                      <div class="flex-1">
                        <div class="text-[13px] w-44 truncate leading-5 text-[#414d6a]" title="{{ $procedure_file_response->name }}">{{ $procedure_file_response->name }}</div>
                        <div class="text-[13px] w-44 truncate leading-5 text-[#414d6a]" title="{{ $procedure_file_response->state }}">{{ $procedure_file_response->state }}</div>
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
    @if ($procedure_data[0]->state == "aprobado" || $procedure_data[0]->state == 'cancelado')
      <div class="w-full md:w-1/2 lg:w-1/4 mb-4">
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


