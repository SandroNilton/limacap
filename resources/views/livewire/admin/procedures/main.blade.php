<div>
  <div class="grid grid-cols-1 gap-6 md:grid-cols-3 lg:grid-cols-4">
    <div>
      <div class="bg-white bg-opacity-100 border-b border-opacity-100 rounded-md border-[rgb(229,231,235)] shadow p-4">
        <div class="flex justify-between mb-5">
          <h4 class=" text-base text-opacity-100 text-[rgb(17,24,39)] font-semibold">Detalles</h4>
        </div>
        <span class="flex items-center gap-3 mb-3 text-emerald-500">
          <ion-icon name="hourglass-outline" class="text-lg" wire:ignore></ion-icon>
          <span class="text-sm font-medium">{{ $this->procedure_data->state }}</span>
        </span>
        <span class="flex items-center gap-3 mb-3">
          <ion-icon name="people-outline" class="text-lg" wire:ignore></ion-icon>
          <span class="text-sm font-medium">Clase: {{ $this->procedure_data->user->type }}</span>
        </span>
        <span class="flex items-center gap-3 mb-3">
          <ion-icon name="person-outline" class="text-lg" wire:ignore></ion-icon>
          <span class="text-sm font-medium">Nombre: {{ $this->procedure_data->user->name }}</span>
        </span>
        <span class="flex items-center gap-3 mb-3">
          <ion-icon name="folder-outline" class="text-lg" wire:ignore></ion-icon>
          <span class="text-sm font-medium">Categoría: {{ $this->procedure_data->typeprocedure->category->name }}</span>
        </span>
        <span class="flex items-center gap-3 mb-3">
          <ion-icon name="file-tray-outline" class="text-lg" wire:ignore></ion-icon>
          <span class="text-sm font-medium">Área: {{ $this->procedure_data->area->name }}</span>
        </span>
        <span class="flex items-center gap-3 mb-3">
          <ion-icon name="briefcase-outline" class="text-lg" wire:ignore></ion-icon>
          <span class="text-sm font-medium">Tipo: {{ $this->procedure_data->typeprocedure->name }}</span>
        </span>
        <span class="flex items-center gap-3 mb-3">
          <ion-icon name="chatbox-ellipses-outline" class="text-lg" wire:ignore></ion-icon>
          <span class="text-sm font-medium">Descripción: {{ $this->procedure_data->description }}</span>
        </span>
        <span class="flex items-center gap-3 mb-3">
          <ion-icon name="calendar-clear-outline" class="text-lg" wire:ignore></ion-icon>
          <span class="text-sm font-medium">Creado: {{ $this->procedure_data->created_at->format('d/m/Y h:i a') }}</span>
        </span>
      </div>
    </div>
    @if ($this->procedure_data->state == "Aprobado" || $this->procedure_data->state == "Rechazado")
    @else
      <div>
        <div class="bg-white bg-opacity-100 border-b border-opacity-100 rounded-md border-[rgb(229,231,235)] shadow p-4">
          <div class="flex justify-between mb-5">
            <h4 class="text-opacity-100 text-[rgb(17,24,39)] font-semibold">Control</h4>
          </div>
          <div>
            <h4 class="mb-2 text-opacity-100 text-[rgb(17,24,39)] text-sm">Asignar a área</h4>
            @can('admin.procedures.assign_area')
              <form wire:submit.prevent="assignArea" class="flex w-full gap-x-2.5 mb-3">
                <x-select wire:model="area">
                  <option value="">Seleccione el area</option>
                  @foreach ($areas as $area)
                    <option value="{{ $area->id }}">{{ $area->name }}</option>
                  @endforeach
                </x-select>
                <x-primary-button wire:ignore>
                  <ion-icon name="checkmark-circle-outline" class="text-lg"></ion-icon>
                </x-primary-button>
              </form>
              <x-input-error :messages="$errors->get('area')" class="mt-2" />
            @endcan
          </div>
          <hr class="my-4">
          <div>
            <h4 class="mb-2 text-opacity-100 text-[rgb(17,24,39)] text-sm">Asignar a usuario</h4>
            @can('admin.procedures.assign_user')
              <form wire:submit.prevent="assignUser" class="flex w-full gap-x-2.5 mb-3">
                <x-select wire:model="user">
                  <option value="">Seleccione el usuario</option>
                  @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                  @endforeach
                </x-select>
                <x-primary-button wire:ignore>
                  <ion-icon name="checkmark-circle-outline" class="text-lg"></ion-icon>
                </x-primary-button>
              </form>
              <x-input-error :messages="$errors->get('user')" class="mt-2" />
            @endcan
          </div>
        </div>
      </div>
    @endif
    <div>
      <div class="bg-white bg-opacity-100 border-b border-opacity-100 rounded-md border-[rgb(229,231,235)] shadow p-4">
        <div class="flex justify-between mb-5">
          <h4 class="text-opacity-100 text-[rgb(17,24,39)] font-semibold">Comentarios</h4>
        </div>
        <div>
          @if ($this->procedure_data->state == "Aprobado" || $this->procedure_data->state == "Rechazado")
          @else
            <form wire:submit.prevent="addComment" class="flex w-full gap-x-2.5 mb-3">
              <x-text-input type="text" wire:model="comment" name="comment" placeholder="Ingrese un mensaje"/>
              <x-primary-button wire:ignore>
                <ion-icon name="checkmark-circle-outline" class="text-lg"></ion-icon>
              </x-primary-button>
            </form>
            <x-input-error :messages="$errors->get('comment')" class="mt-2" />
          @endif
          <hr class="my-4">
          <div class="overflow-y-scroll scrollbar h-auto max-h-72 rounded-[3px] scroll">
            @forelse ($comments as $comment)
              <div class="flex items-center mb-2 group gap-x-3">
                <div class="flex items-end">
                    <div class="flex flex-col items-start order-2 max-w-xs mx-2 space-y-2">
                      <div>
                        <span class="px-4 py-2 rounded-lg rounded-bl-none bg-gray-100 text-[rgb(17,24,39)] grid">
                          <span class="text-xs">{{ $comment->user->name }} - {{ $comment->created_at->format('d/m/Y h:i a') }}</span>
                          <span class="text-sm">{{ $comment->description }}</span>
                        </span>
                      </div>
                    </div>
                    <img src="https://c1.klipartz.com/pngpicture/823/765/sticker-png-login-icon-system-administrator-user-user-profile-icon-design-avatar-face-head.png" alt="My profile" class="order-1 rounded-full w-7 h-7">
                </div>
              </div>
            @empty
              <div class="w-full border border-dashed border-gray-300 rounded-[3px] flex py-1.5 justify-center text-sm">
                No hay comentarios
              </div>
            @endforelse
          </div>
        </div>
      </div>
    </div>
    <div>
      <div class="bg-white bg-opacity-100 border-b border-opacity-100 rounded-md border-[rgb(229,231,235)] shadow p-4">
        <div class="flex justify-between mb-5">
          <h4 class="text-opacity-100 text-[rgb(17,24,39)] font-semibold">Archivos subidos</h4>
        </div>
        <div>
          @forelse ($files_uploaded as $file)
            <div class="items-center p-3 border border-gray-200 rounded-md">
              <div class="text-sm w-52 truncate text-[rgb(17,24,39)] mb-1.5" title="{{ $file->name }}">{{ $file->name }}</div>
              <div class="grid grid-cols-6 gap-3">
                <div class="col-span-1">
                  <x-secondary-button wire:click="downloadFile('{{ $file->id }}', '{{ $file->name }}', '{{ $file->file }}')">
                    <ion-icon  wire:ignore name="download-outline" class="text-lg"></ion-icon>
                  </x-secondary-button>
                </div>
                @if ($this->procedure_data->state == "Aprobado" || $this->procedure_data->state == "Rechazado")
                @else
                  <div class="col-span-5">
                    <form wire:submit.prevent="changeState(Object.fromEntries(new FormData($event.target)))" class="flex gap-3">
                      <input type="hidden" name="file_id" value="{{ $file->id }}">
                      <x-select id="{{ $file->id }}" name="state">
                        <option value="Sin verificar" @if($file->state == "Sin verificar") @selected(true) @else @selected(false) @endif>Sin verificar</option>
                        <option value="Aceptado" @if($file->state == "Aceptado") @selected(true) @else @selected(false) @endif>Aceptado</option>
                        <option value="Rechazado" @if($file->state == "Rechazado") @selected(true) @else @selected(false) @endif>Rechazado</option>
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
    </div>
    <div>
      <div class="bg-white bg-opacity-100 border-b border-opacity-100 rounded-md border-[rgb(229,231,235)] shadow p-4">
        <div class="flex justify-between mb-5">
          <h4 class="text-opacity-100 text-[rgb(17,24,39)] font-semibold">Archivos de cambios de estado</h4>
        </div>
        <div>
          @forelse ($files_answers as $file)
            <div class="items-center p-3 mb-3 border border-gray-200 rounded-md">
              <div class="flex items-center justify-between gap-3">
                <x-secondary-button wire:click="downloadFile('{{ $file->id }}', '{{ $file->name }}', '{{ $file->file }}')">
                  <ion-icon  wire:ignore name="download-outline" class="text-lg"></ion-icon>
                </x-secondary-button>
                <div class="text-sm w-52 truncate text-[rgb(17,24,39)]" title="{{ $file->name }}">{{ $file->name }}</div>
                <div class="text-sm text-[rgb(17,24,39)]" title="{{ $file->state }}">{{ $file->state }}</div>
              </div>
            </div>
          @empty
            <div class="w-full border border-dashed border-gray-300 rounded-[3px] flex py-1.5 justify-center text-sm">
              No hay archivos
            </div>
          @endforelse
        </div>
      </div>
    </div>
    <div>
      <div class="bg-white bg-opacity-100 border-b border-opacity-100 rounded-md border-[rgb(229,231,235)] shadow p-4">
        <div class="flex justify-between mb-5">
          <h4 class="text-opacity-100 text-[rgb(17,24,39)] font-semibold">Comentarios de cambios de estado</h4>
        </div>
        <div class="overflow-y-scroll scrollbar max-h-80 scroll">
          @forelse ($comments_finish as $comment)
            <div class="relative flex pb-2 overflow-hidden gap-x-4">
              <div wire:ignore class="mt-0.5 relative h-full">
                <ion-icon name="chatbox-ellipses-outline" class="text-lg p-1 rounded-full bg-[#10B981] text-white"></ion-icon>
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
      </div>
    </div>
    @if ($this->procedure_data->state == "Aprobado" || $this->procedure_data->state == "Rechazado")
      <div>
        <div class="bg-white bg-opacity-100 border-b border-opacity-100 rounded-md border-[rgb(229,231,235)] shadow p-4">
          <div class="flex justify-between mb-5">
            <h4 class="text-opacity-100 text-[rgb(17,24,39)] font-semibold">Archivos de finalización</h4>
            <a wire:click="$refresh" class="flex items-center gap-2 cursor-pointer transition hover:text-[#10B981] ease-in-out duration-300 text-lg text-[rgb(17,24,39)] font-medium">
              <x-wire-loading class="w-8 h-8"/>
              <ion-icon name="refresh-outline" wire:ignore></ion-icon>
            </a>
          </div>
          <div>
            @forelse ($files_finish as $file)
              <div class="items-center p-3 mb-3 border border-gray-200 rounded-md">
                <div class="flex items-center justify-between gap-3">
                  <x-secondary-button wire:click="downloadFile('{{ $file->id }}', '{{ $file->name }}', '{{ $file->file }}')">
                    <ion-icon  wire:ignore name="download-outline" class="text-lg"></ion-icon>
                  </x-secondary-button>
                  <div class="text-sm w-52 truncate text-[rgb(17,24,39)]" title="{{ $file->name }}">{{ $file->name }}</div>
                  <div class="text-sm text-[rgb(17,24,39)]" title="{{ $file->state }}">{{ $file->state }}</div>
                </div>
              </div>
            @empty
              <div class="w-full border border-dashed border-gray-300 rounded-[3px] flex py-1.5 justify-center text-sm">
                No hay archivos
              </div>
            @endforelse
          </div>
        </div>
      </div>
    @endif
    <div>
      <div class="bg-white bg-opacity-100 border-b border-opacity-100 rounded-md border-[rgb(229,231,235)] shadow p-4">
        <div class="flex justify-between mb-5">
          <h4 class="text-opacity-100 text-[rgb(17,24,39)] font-semibold">Historial</h4>
        </div>
        <div class="overflow-y-scroll scrollbar max-h-80 scroll">
          @forelse ($records as $record)
            <div class="relative flex pb-2 overflow-hidden gap-x-4">
              <div wire:ignore class="mt-0.5 relative h-full">
                <ion-icon name="time-outline" class="text-lg p-1 rounded-full bg-[#10B981] text-white"></ion-icon>
              </div>
              <p class="px-1 py-1 text-sm">
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
    </div>
    @if ($this->procedure_data->state == "Aprobado" || $this->procedure_data->state == "Rechazado")
    @else
      <div>
        <div class="bg-white bg-opacity-100 border-b border-opacity-100 rounded-md border-[rgb(229,231,235)] shadow p-4">
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
              <option value="Observado" @if( $this->procedure_data->state == "Observado") @selected(true) @else @selected(false) @endif>Observado</option>
              <option value="Revisado" @if( $this->procedure_data->state == "Revisado") @selected(true) @else @selected(false) @endif>Revisado</option>
              @if ($files_out->count() > 0)
              @else
                <option value="Aprobado" @if( $this->procedure_data->state == "Aprobado") @selected(true) @else @selected(false) @endif>Aprobado</option>
              @endif
              <option value="Cancelado" @if( $this->procedure_data->state == "Cancelado") @selected(true) @else @selected(false) @endif>Cancelado</option>
            </x-select>
            <x-text-area wire:model="description" name="description" placeholder="descripción" class="mb-3"></x-text-area>
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
      </div>
    @endif
  </div>
</div>
