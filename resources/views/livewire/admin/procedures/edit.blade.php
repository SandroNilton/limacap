<div>
  <div class="flex justify-between items-center py-2.5 px-2.5 border-b border-[#cdd5de] bg-white">
    <span class="text-[#414d6a] text-xs">Editar trámite</span>
  </div>
  <div class="p-[14px] bg-[#f1f3f6] sm:flex gap-3">

    <div class="w-full md:w-1/2 lg:w-1/4 mb-4">
      <!-- Info procedure -->
      <div class="border border-[#cdd5de] bg-white mb-4 rounded-[3px]">
        <div class="w-full flex justify-between items-center py-2 px-2.5 border-b border-[#cdd5de]">
          <span class="text-xs text-[#414d6a]">Asignar trámite a otra área:</span>
        </div>
        <div class="w-full p-[12px]">
          <ul class="flex flex-col text-left gap-2.5">
            <li class="flex gap-x-3 overflow-hidden">
              <p class="text-xs">
                <span>Fecha de creación:</span>
                <span>{{ $procedure_data[0]->created_at->format('d/m/Y h:i') }}</span>
              <p>
            </li>
            <li class="flex gap-x-3 overflow-hidden">
              <p class="text-xs">
                <span>Tipo de trámite:</span>
                <span>{{ $procedure_data[0]->typeprocedure->name }}</span>
              </p>
            </li>
            <li class="flex gap-x-3 overflow-hidden">
              <p class="text-xs">
                <span>Área:</span>
                <span>{{ $procedure_data[0]->area->name }}</span>
              </p>
            </li>
            <li class="flex gap-x-3 overflow-hidden">
              <p class="text-xs">
                <span>Tipo de usuario:</span>
                <span>@switch($procedure_data[0]->user->type) @case(1) Natural @break @case(2) Juridica  @break @case(3) Agremiado @break @case(10)  Administrativo @break @endswitch</span>
              </p>
            </li>
            <li class="flex gap-x-3 overflow-hidden">
              <p class="text-xs">
                <span>Nombre:</span>
                <span>{{ $procedure_data[0]->user->name }}</span>
              </p>
            </li>
            <li class="flex gap-x-3 overflow-hidden">
              <p class="text-xs">
                <span>Descripción:</span>
                <span>@if (!empty($procedure_data[0]->description)) {{ $procedure_data[0]->description }} @else --  @endif</span>
              </p>
            </li>
          </ul>
        </div>
      </div>
      @if ($procedure_data[0]->state == 5)
      @else
        <!-- Change area -->
        @can('admin.procedures.assign_area')
          <div class="border border-[#cdd5de] bg-white mb-4">
            <div class="w-full flex justify-between items-center py-2 px-2.5 border-b border-[#cdd5de]">
              <span class="text-xs text-[#414d6a]">Asignar trámite a otra área:</span>
            </div>
            <div class="w-full p-[12px]">
              <form wire:submit.prevent="changeArea" class="flex w-full gap-x-3">
                <select wire:model="area_id" class="w-full py-1.5 text-xs rounded-[3px] border-[#cdd5de] focus:border-[#4482ff] hover:border-[#4482ff] focus:ring-0 transition duration-300 @if($errors->has('area_id')) border-[#d72d30] @endif">
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
              <span class="text-xs text-[#414d6a]">Asignar trámite a otra área:</span>
            </div>
            <div class="w-full p-[12px]">
              <form wire:submit.prevent="assignUser" class="flex w-full gap-x-3">
                <select wire:model="user_id" class="w-full py-1.5 text-xs rounded-[3px] border-[#cdd5de] focus:border-[#4482ff] hover:border-[#4482ff] focus:ring-0 transition duration-300 @if($errors->has('user_id')) border-[#d72d30] @endif">
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
          <span class="text-xs text-[#414d6a]">Mensaje de trámite:</span>
        </div>
        <div class="w-full p-[12px]">
          @if ($procedure_data[0]->state == 5)
          @else
            <div class="flex text-sm mb-3">
              <form wire:submit.prevent="addMessage" class="flex w-full gap-x-3">
                <input type="text" wire:model="message" name="message" class="w-full py-1.5 text-xs rounded-[3px] border-[#cdd5de] focus:border-[#4482ff] hover:border-[#4482ff] focus:ring-0 transition duration-300 @if($errors->has('message')) border-[#d72d30] @endif" placeholder="Ingrese un mensaje"/>
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
                      <h1 class="text-xs">{{ $procedure_message->description }}</h1>
                    </div>
                  </div>
                </div>
              @empty
                <div class="w-full border border-dashed border-[#cdd5de] rounded-[3px] flex py-1.5 justify-center text-xs text-[#cdd5de]">
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
          <span class="text-xs text-[#414d6a]">Archivos solicitados:</span>
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
                    <div class="text-[13px] w-44 truncate" title="{{ $procedure_file->name }}">{{ $procedure_file->name }}</div>
                    @if ($procedure_data[0]->state == 'aceptado')
                    @else
                      <div class="flex gap-x-3">
                        <form wire:submit.prevent="changeStateFile(Object.fromEntries(new FormData($event.target)))" class="flex w-full gap-x-3">
                          <input type="hidden" name="procedurefile_id" value="{{ $procedure_file->id }}">
                          <select id="{{ $procedure_file->id }}" name="state_id" class="w-full py-1.5 text-xs text-[#414d6a] rounded-[3px] border-[#cdd5de] focus:border-[#4482ff] hover:border-[#4482ff] focus:ring-0 transition duration-300">
                            <option value="sin verificar" @if($procedure_file->state == 1) @selected(true) @else @selected(false) @endif>Sin verificar</option>
                            <option value="aceptado" @if($procedure_file->state == 2) @selected(true) @else @selected(false) @endif>Aceptado</option>
                            <option value="rechazado" @if($procedure_file->state == 3) @selected(true) @else @selected(false) @endif>Rechazado</option>
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
              <div class="w-full border border-dashed border-[#cdd5de] rounded-[3px] flex py-1.5 justify-center text-xs text-[#cdd5de]">
                No hay archivos
              </div>
            @endforelse
          </div>
        </div>
      </div>
    </div>

    <div class="w-full md:w-1/2 lg:w-1/4 mb-4">
      <!-- history -->
      <div class="border border-[#cdd5de] bg-white mb-4 rounded-[3px]">
        <div class="w-full flex justify-between items-center py-2 px-2.5 border-b border-[#cdd5de]">
          <span class="text-xs text-[#414d6a]">Actividad:</span>
        </div>
        <div class="w-full p-[12px]">
          <div class="overflow-y-scroll scrollbar h-auto max-h-72 rounded-[3px]">
            @forelse ($procedure_histories as $procedurehistory)
              <div class="relative flex gap-x-4 pb-2 overflow-hidden">
                <div wire:ignore class="mt-0.5 relative h-full">
                  <div class="absolute top-5 bottom-0 left-2 w-px h-32 -ml-px border-r border-dashed border-[#cdd5de]"></div>
                  <ion-icon name="time-outline"></ion-icon>
                </div>
                <p class="py-1 px-1 text-xs font-medium ">
                  <span>{{ $procedurehistory->created_at->format('d/m/Y h:i') }} - </span> {{ $procedurehistory->action }}
                </p>
              </div>
            @empty
              <div class="w-full border border-dashed border-[#cdd5de] rounded-[3px] flex py-1.5 justify-center text-xs text-[#cdd5de]">
                Sin historial
              </div>
            @endforelse
          </div>
        </div>
      </div>
      <!-- finish procedure -->
      <div class="border border-[#cdd5de] bg-white mb-4 rounded-[3px]">
        <div class="w-full flex justify-between items-center py-2 px-2.5 border-b border-[#cdd5de]">
          <span class="text-xs text-[#414d6a]">Finalizar trámite:</span>
        </div>
        <div class="w-full p-[12px]">
          @if ($procedure_data[0]->state == 5)
          @else
            @if ($procedure_accepted->count() > 0)
              <div class="text-xs">Para generar la opción de finalizacion de trámite por favor aceptar todos los archivos adjuntos.</div>
            @else
              <div>
                <div class="items-center">
                  <p class="text-sm font-poppins text-gray-600 mb-3">Finalizar trámite: @error('message_finish') <span class="px-3 text-xs scale-75 text-[#d72d30] mb-0 mt-0.5">{{ $message }}</span> @enderror @error('file_finish') <span class="px-3 text-xs scale-75 text-[#d72d30] mb-0 mt-0.5">{{ $message }}</span> @enderror</p>
                  <div class="text-sm mb-3">
                    <form wire:submit.prevent="finish_procedure" class="w-full gap-x-3">
                      <div wire:loading wire:target="finish_procedure">
                        <div class="flex justify-center items-center h-full">
                          <svg class="h-6 w-6 animate-spin" viewBox="3 3 18 18">
                            <path class="fill-gray-200" d="M12 5C8.13401 5 5 8.13401 5 12C5 15.866 8.13401 19 12 19C15.866 19 19 15.866 19 12C19 8.13401 15.866 5 12 5ZM3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12Z"></path>
                            <path class="fill-[#42a692]" d="M16.9497 7.05015C14.2161 4.31648 9.78392 4.31648 7.05025 7.05015C6.65973 7.44067 6.02656 7.44067 5.63604 7.05015C5.24551 6.65962 5.24551 6.02646 5.63604 5.63593C9.15076 2.12121 14.8492 2.12121 18.364 5.63593C18.7545 6.02646 18.7545 6.65962 18.364 7.05015C17.9734 7.44067 17.3403 7.44067 16.9497 7.05015Z"></path>
                          </svg>
                        </div>
                      </div>
                      <input type="text" wire:model="message_finish" class="rounded peer bg-transparent block w-full py-1.5 text-sm border-[#cfd7df] hover:border-[#42a692] transition duration-300 focus:border-[#42a692] focus:outline-none focus:ring-0 @if($errors->has('messagefinish')) border-[#d72d30] @endif" placeholder="Ingrese un mensaje"/>
                      <input type="file" wire:model="file_finish" class="py-3" multiple class="text-[#183247] w-full bg-white py-1.5 px-3.5 relative m-0 block flex-auto cursor-pointer rounded border border-[#cfd7df] hover:border-[#42a692] transition-all bg-clip-padding text-sm duration-300 ease-in-out file:-mx-3 file:-my-[0.32rem] file:cursor-pointer file:overflow-hidden file:rounded file:border-0 file:border-solid file:border-inherit file:bg-[#42a692] file:text-white file:px-3 file:py-[0.32rem] file:transition file:duration-150 file:ease-in-out file:[border-inline-end-width:1px] file:[margin-inline-end:0.75rem] focus:outline-none">
                      <button type="submit" class="w-full p-0.5 px-2 bg-[#42a692] rounded text-white text-sm hover:bg-[#2c6f62] transition duration-300">Finalizar</button>
                    </form>
                  </div>
                </div>
              </div>
            @endif
          @endif
        </div>
      </div>
    </div>
  </div>
</div>
