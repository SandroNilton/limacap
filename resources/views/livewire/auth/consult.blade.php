<div class="w-full h-full p-4">
    <div class="flex flex-col h-full gap-4 w-full items-center">
        <p class="mb-1 text-md font-semibold text-[rgb(17,24,39)] text-opacity-100">Consulta el estado de tu trámite</p>
    <div class="w-1/2">
        <form wire:submit.prevent="consult">
            <div class="mb-3">
                <x-text-input wire:model="code" type="text" name="code" placeholder="Codigo"/>
                <x-input-error :messages="$errors->get('code')" class="mt-2" />
            </div>
            <x-primary-button class="gap-2">
                <ion-icon name="add-circle-outline" class="text-lg" wire:ignore></ion-icon>Consultar
            </x-primary-button>
        </form>
    </div>
    <div class="grid grid-cols-1 gap-4">
        <div>
            @if ($procedure_data != null)
                <div class="bg-white bg-opacity-100 border-b border-opacity-100 rounded-md border-[rgb(229,231,235)] shadow p-4">
                    <div class="grid grid-cols-1 gap-6 divide-x-4 divide-red-600 md:grid-cols-3 lg:grid-cols-4">
                        <div class="space-y-6">
                          <div>
                            <div class="bg-white bg-opacity-100 border-b border-opacity-100 rounded-md border-[rgb(229,231,235)] shadow p-4">
                              <div class="flex justify-between mb-5">
                                <h4 class=" text-md text-opacity-100 text-[rgb(17,24,39)] font-bold">DETALLE DEL TRAMITE</h4>
                              </div>
                              <span class="flex items-center gap-3 mb-3">
                                <ion-icon name="person-outline" class="text-lg" wire:ignore></ion-icon>
                              </span>
                              <span class="flex items-center gap-3 mb-3">
                                <ion-icon name="file-tray-outline" class="text-lg" wire:ignore></ion-icon>
                                <span class="text-sm font-medium">Área: {{ $procedure_data[0]->area->name }}</span>
                              </span>
                              <span class="flex items-center gap-3 mb-3">
                                <ion-icon name="briefcase-outline" class="text-lg" wire:ignore></ion-icon>
                                <span class="text-sm font-medium">Tipo: {{ $procedure_data[0]->typeprocedure->name }}</span>
                              </span>
                              <span class="flex items-center gap-3 mb-3">
                                <ion-icon name="chatbox-ellipses-outline" class="text-lg" wire:ignore></ion-icon>
                                <span class="text-sm font-medium">Descripción: @if (!empty($procedure_data[0]->description)) {{ $procedure_data[0]->description }} @else --  @endif</span>
                              </span>
                              <span class="flex items-center gap-3 mb-3">
                                <ion-icon name="calendar-clear-outline" class="text-lg" wire:ignore></ion-icon>
                                <span class="text-sm font-medium">Creado: {{ $procedure_data[0]->created_at->format('d/m/Y h:i') }}</span>
                              </span>
                            </div>
                          </div>
                          <div>
                            <div class="bg-white bg-opacity-100 border-b border-opacity-100 rounded-md border-[rgb(229,231,235)] shadow p-4">
                              <div class="flex justify-between mb-5">
                                <h4 class="text-opacity-100 text-[rgb(17,24,39)] font-semibold">Archivos subidos</h4>
                              </div>
                              <div class="flex flex-col grid-cols-1 text-sm columns-1 gap-x-3">
                                @forelse ($procedure_files as $procedure_file)
                                  @if($procedure_file->state == "Rechazado")
                                    <div class="min-w-full border border-dashed border-[#cdd5de] rounded-[3px]">
                                      <div class="flex items-center flex-1 p-2 rounded-sm gap-x-3">
                                        <button wire:click="downloadFile('{{ $procedure_file->id }}', '{{ $procedure_file->name }}', '{{ $procedure_file->file }}')" class="flex justify-center items-center rounded-[3px] w-8 h-[51px] bg-[#0d8a72] text-white text-[18px] cursor-pointer">
                                          <ion-icon  wire:ignore name="download-outline"></ion-icon>
                                        </button>
                                        <div class="flex-1">
                                          {{ $procedure_data[0]->state }}
                                          <div class="text-[13px] w-44 truncate leading-5 text-[#414d6a]" title="{{ $procedure_file->name }}">{{ $procedure_file->name }}</div>
                                          @if ($procedure_data[0]->state == 'Aprobado' || $procedure_data[0]->state == 'Cancelado')
                                          @else
                                            <div class="flex gap-x-3">
                                                <div class="flex text-[13px] leading-4 mb-3">
                                                    <form wire:submit.prevent="changeFile('{{ $procedure_file->id }}', '{{ $procedure_file->requirement_id }}', '{{ $procedure_file->name }}', '{{ $procedure_file->file }}')" enctype="multipart/form-data" class="flex w-full gap-x-2.5">
                                                        <div class="border border-dashed border-[#d9d9da] transition duration-300 flex flex-row rounded-[3px] hover:border-[#0d8a72] gap-x-2.5">
                                                            <div class="px-4 inline-flex items-center border-r border-[#d9d9da] bg-white">
                                                            <span class="text-[13px] text-[#414d6a]">Archivo</span>
                                                            </div>
                                                            <input type="file" wire:model="file_replace" id="file_replace" class="cursor-pointer w-full flex text-[13px] leading-4 text-center justify-center bg-white py-1.5 px-3.5 relative m-0 flex-auto duration-300 ease-in-out file:hidden focus:outline-none">
                                                        </div>
                                                        <button type="submit" class="bg-[#0d8a72] px-1 rounded-[3px] text-white text-[20px] py-1 inline-flex items-center">
                                                            <ion-icon wire:ignore name="refresh-outline"></ion-icon>
                                                        </button>
                                                    </form>
                                                  </div>

                                            </div>
                                          @endif
                                        </div>
                                      </div>
                                    </div>
                                  @else
                                    <div class="min-w-full border border-dashed border-[#cdd5de] rounded-[3px]">
                                        <div class="flex items-center flex-1 p-2 rounded-sm gap-x-3">
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
                        <div class="space-y-6">
                          <div class="bg-white bg-opacity-100 border-b border-opacity-100 rounded-md border-[rgb(229,231,235)] shadow p-4">
                            <div class="flex justify-between mb-5">
                              <h4 class="text-opacity-100 text-[rgb(17,24,39)] font-semibold">Respuestas de trámite</h4>
                            </div>
                            <div class="w-full">
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
                          <div class="bg-white bg-opacity-100 border-b border-opacity-100 rounded-md border-[rgb(229,231,235)] shadow p-4">
                            <div class="flex justify-between mb-5">
                              <h4 class="text-opacity-100 text-[rgb(17,24,39)] font-semibold">Archivos de cambios de estado</h4>
                            </div>
                            <div class="w-full">
                              <div class="flex flex-col grid-cols-1 text-sm columns-1 gap-x-3">
                                @forelse ($procedure_files_responses as $procedure_file_response)
                                  <div class="min-w-full border border-dashed border-[#cdd5de] rounded-[3px]">
                                    <div class="flex items-center flex-1 p-2 rounded-sm gap-x-3">
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
                          @if ($procedure_data[0]->state == "Aprobado" || $procedure_data[0]->state == 'Cancelado')
                            <div class="bg-white bg-opacity-100 border-b border-opacity-100 rounded-md border-[rgb(229,231,235)] shadow p-4">
                              <div class="flex justify-between mb-5">
                                <h4 class="text-opacity-100 text-[rgb(17,24,39)] font-semibold">Archivos de finalización</h4>
                              </div>
                              <div class="w-full">
                                <div class="flex flex-col grid-cols-1 text-sm columns-1 gap-x-3">
                                  @forelse ($procedure_files_finish as $procedure_file_finish)
                                    <div class="min-w-full border border-dashed border-[#cdd5de] rounded-[3px]">
                                      <div class="flex items-center flex-1 p-2 rounded-sm gap-x-3">
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
                      </div>
                </div>
            @else
                <div>no data buscadA</div>
            @endif

        </div>
    </div>
    </div>
</div>
