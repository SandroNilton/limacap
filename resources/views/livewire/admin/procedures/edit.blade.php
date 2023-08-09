<div>
  <div class="flex justify-between items-center py-2.5 px-2.5 border-b border-[#cdd5de] bg-white">
    <span class="text-[#414d6a] text-xs">Editar trámite</span>
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
      @if ($procedure_data[0]->state == 'aprobado' || $procedure_data[0]->state == 'rechazado')
      @else
        <!-- Change area -->
        @can('admin.procedures.assign_area')
          <div class="border border-[#cdd5de] bg-white mb-4">
            <div class="w-full flex justify-between items-center py-2 px-2.5 border-b border-[#cdd5de]">
              <span class="text-[13px] leading-4 text-[#414d6a]">Asignar trámite a otra área:</span>
            </div>
            <div class="w-full p-[12px]">
              <form wire:submit.prevent="changeArea" class="flex w-full gap-x-2.5">
                <select wire:model="area_id" class="rounded-[3px] peer bg-transparent block w-full py-1.5 leading-4 text-[13px] border-[#cdd5de] focus:border-inherit focus:ring-0 @if($errors->has('area_id')) border-[#d72d30] @endif">
                  <option value="">Seleccione el area</option>
                  @foreach ($areas as $area)
                    <option value="{{ $area->id }}" selected>{{ $area->name }}</option>
                  @endforeach
                </select>
                <button wire:ignore class="bg-[#0d8a72] px-1 rounded-[3px] text-white text-[20px] py-1 inline-flex items-center">
                  <ion-icon name="checkmark-circle-outline"></ion-icon>
                </button>
              </form>
            </div>
          </div>
        @endcan
        <!-- Change user -->
        @can('admin.procedures.assign_user')
          <div class="border border-[#cdd5de] bg-white mb-4">
            <div class="w-full flex justify-between items-center py-2 px-2.5 border-b border-[#cdd5de]">
              <span class="text-[13px] leading-4 text-[#414d6a]">Asignar trámite a usuario:</span>
            </div>
            <div class="w-full p-[12px]">
              <form wire:submit.prevent="assignUser" class="flex w-full gap-x-2.5">
                <select wire:model="user_id" class="rounded-[3px] peer bg-transparent block w-full py-1.5 leading-4 text-[13px] border-[#cdd5de] focus:border-inherit focus:ring-0 @if($errors->has('user_id')) border-[#d72d30] @endif">
                  <option value="">Seleccione el usuario</option>
                  @foreach ($users as $user)
                    <option value="{{ $user->id }}" selected>{{ $user->name }}</option>
                  @endforeach
                </select>
                <button  wire:ignore class="bg-[#0d8a72] px-1 rounded-[3px] text-white text-[20px] py-1 inline-flex items-center">
                  <ion-icon name="checkmark-circle-outline"></ion-icon>
                </button>
              </form>
            </div>
          </div>
        @endcan
      @endif
    </div>

    <div class="w-full md:w-1/2 lg:w-1/4 mb-4">
      <!-- Message -->
      <div class="border border-[#cdd5de] bg-white mb-4 rounded-[3px]">
        <div class="w-full flex justify-between items-center py-2 px-2.5 border-b border-[#cdd5de]">
          <span class="text-[13px] leading-4 text-[#414d6a]">Mensaje de trámite:</span>
        </div>
        <div class="w-full p-[12px]">
          @if ($procedure_data[0]->state == 'aprobado' || $procedure_data[0]->state == 'rechazado')
          @else
            <div class="flex text-[13px] leading-4 mb-3">
              <form wire:submit.prevent="addMessage" class="flex w-full gap-x-2.5">
                <input type="text" wire:model="message" name="message" class="rounded-[3px] peer bg-transparent block w-full py-1.5 leading-4 text-[13px] border-[#cdd5de] focus:border-inherit focus:ring-0 @if($errors->has('message')) border-[#d72d30] @endif" placeholder="Ingrese un mensaje"/>
                <button type="submit" class="bg-[#0d8a72] px-1 rounded-[3px] text-white text-[20px] py-1 inline-flex items-center">
                  <ion-icon wire:ignore name="checkmark-circle-outline"></ion-icon>
                </button>
              </form>
            </div>
          @endif
          <div class="mt-3">
            <div class="overflow-y-scroll scrollbar h-auto max-h-72 rounded-[3px]">
              @forelse ($procedure_messages as $procedure_message)
                <div class="group flex items-center gap-x-3 mb-2">
                  <div class="transform relative flex items-center p-2 bg-[#0d8a72] text-white rounded-[3px] flex-col md:flex-row space-y-4 md:space-y-0">
                    <div class="flex-auto">
                      <h1 class="text-[10px]">{{ $procedure_message->created_at->format('d/m/Y h:i') }}</h1>
                      <h1 class="text-[13px] leading-4">{{ $procedure_message->description }}</h1>
                    </div>
                  </div>
                </div>
              @empty
                <div class="w-full border border-dashed border-[#cdd5de] rounded-[3px] flex py-1.5 justify-center text-[13px] leading-4 text-[#cdd5de]">
                  Sin mensajes
                </div>
              @endforelse
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="w-full md:w-1/2 lg:w-1/4 mb-4">
      <!-- files -->
      <div class="border border-[#cdd5de] bg-white mb-4 rounded-[3px]">
        <div class="w-full flex justify-between items-center py-2 px-2.5 border-b border-[#cdd5de]">
          <span class="text-[13px] leading-4 text-[#414d6a]">Archivos solicitados:</span>
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
                    @if ($procedure_data[0]->state == 'aprobado' || $procedure_data[0]->state == 'rechazado')
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
      </div>

      @if ($procedure_data[0]->state == 'aprobado' || $procedure_data[0]->state == 'rechazado')
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
            <span class="text-[13px] leading-4 text-[#414d6a]">Archivos de finalización:</span>
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
      @endif
    </div>

    <div class="w-full md:w-1/2 lg:w-1/4 mb-4">
      <!-- history -->
      <div class="border border-[#cdd5de] bg-white mb-4 rounded-[3px]">
        <div class="w-full flex justify-between items-center py-2 px-2.5 border-b border-[#cdd5de]">
          <span class="text-[13px] leading-4 text-[#414d6a]">Historial de actividad:</span>
        </div>
        <div class="w-full p-[12px]">
          <div class="overflow-y-scroll scrollbar h-auto max-h-72 rounded-[3px]">
            @forelse ($procedure_histories as $procedurehistory)
              <div class="relative flex gap-x-4 pb-2 overflow-hidden">
                <div wire:ignore class="mt-0.5 relative h-full">
                  <div class="absolute top-5 bottom-0 left-2 w-px h-32 -ml-px border-r border-dashed border-[#cdd5de]"></div>
                  <ion-icon name="time-outline"></ion-icon>
                </div>
                <p class="py-1 px-1 text-[13px] leading-4 text-[#414d6a] font-medium ">
                  <span>{{ $procedurehistory->created_at->format('d/m/Y h:i') }} - </span> {{ $procedurehistory->action }}
                </p>
              </div>
            @empty
              <div class="w-full border border-dashed border-[#cdd5de] rounded-[3px] flex py-1.5 justify-center text-[13px] leading-4 text-[#cdd5de]">
                Sin historial
              </div>
            @endforelse
          </div>
        </div>
      </div>
      <!-- finish procedure -->
      <div class="border border-[#cdd5de] bg-white mb-4 rounded-[3px]">
        <div class="w-full flex justify-between items-center py-2 px-2.5 border-b border-[#cdd5de]">
          <span class="text-[13px] leading-4 text-[#414d6a]">Finalizar trámite:</span>
        </div>
        <div class="w-full p-[12px]">
          @if ($procedure_data[0]->state == 'aprobado' || $procedure_data[0]->state == 'rechazado')
            <div class="w-full border border-dashed border-[#414d6a] rounded-[3px] flex py-1.5 justify-center text-[13px] leading-4 text-[#414d6a]">
              Tramite finalizado
            </div>
          @else
            @if ($procedure_accepted->count() > 0)
              <div class="text-[13px] leading-4 text-[#414d6a]">Para generar la opción de finalizacion de trámite por favor aceptar todos los archivos adjuntos.</div>
            @else
              <div>
                <div class="items-center">
                  <div class="text-sm mb-3">
                    <form wire:submit.prevent="finish_procedure" class="w-full gap-x-3">
                      <div class="mb-3">
                        <textarea type="text" wire:model="message_finish" class="rounded-[3px] peer bg-transparent block w-full py-1.5 leading-4 text-[13px] border-[#cdd5de] focus:border-inherit focus:ring-0 @if($errors->has('messagefinish')) border-[#d72d30] @endif" placeholder="Ingrese un mensaje de finalizacion"></textarea>
                      </div>
                      <div class="mb-3">
                        <div class="col-span-3 md:col-span-1 border border-dashed border-[#d9d9da] transition duration-300 flex flex-row rounded-[3px] hover:border-[#0d8a72] ">
                          <div class="px-4 inline-flex items-center border-r border-[#d9d9da] bg-white">
                            <span class="text-[13px] text-[#414d6a]">Archivos</span>
                          </div>
                          <input type="file" multiple wire:model="file_finish" id="file_finish" class="cursor-pointer w-full flex text-[13px] leading-4 text-center justify-center bg-white py-1.5 px-3.5 relative m-0 flex-auto duration-300 ease-in-out file:hidden focus:outline-none" accept="" ref="fileInput" @required(true)>
                        </div>
                      </div>
                      <button type="submit" class="bg-[#0d8a72] rounded-[3px] peer text-white block w-full py-1.5 leading-4 text-[13px] focus:ring-0">Finalizar</button>
                    </form>
                  </div>
                </div>
              </div>
            @endif
          @endif
        </div>
      </div>
      @if ($procedure_data[0]->state != 'aprobado' and $procedure_data[0]->state != 'rechazado')
        <div class="border border-[#cdd5de] bg-white mb-4 rounded-[3px]">
          <div class="w-full flex justify-between items-center py-2 px-2.5 border-b border-[#cdd5de]">
            <span class="text-[13px] leading-4 text-[#414d6a]">Rechazar trámite:</span>
          </div>
          <div class="w-full p-[12px]">
            <button wire:click="finish_procedure_decline" class="w-full bg-[#ca2d45] rounded-[3px] flex py-1.5 justify-center text-[13px] leading-4 text-white">
              Rechazar trámite
            </button>
          </div>
        </div>
      @else
      @endif
    </div>
  </div>
</div>
