<div>
  <header class="flex justify-between items-center py-2 px-3 border-b border-[#cdd5de] bg-white">
    <span class="text-[#414d6a] text-[13px]">Nuevo trámite</span>
  </header>
  <div class="p-[12px] bg-[#f1f3f6] sm:flex gap-3">
    <div class="w-full md:w-2/3 lg:w-3/4 mb-4">
      <div class="border border-[#cdd5de] bg-white mb-4 rounded-[3px]">
        <div class="w-full flex justify-between items-center py-2 px-3 border-b border-[#cdd5de]">
          <span class="text-[13px] leading-4 text-[#414d6a]">Parametros de trámite</span>
        </div>
        <div class="w-full p-[12px]">
          <form enctype="multipart/form-data" action="{{ route('app.procedures.store') }}" method="POST">
            @csrf
            <div class="mb-3">
              <label class="text-[13px] leading-4 text-[#414d6a]">Categoría</label>
              <select wire:model="selectedCategory" name="category_id" id="category_id" class="w-full py-1.5 text-[13px] text-[#414d6a] leading-4 rounded-[3px] border-[#cdd5de] focus:border-inherit focus:ring-0" @required(true)>
                <option value="">seleccione la categoría</option>
                @forelse ($categories as $category)
                  <option value="{{ $category->id }}">{{ $category->name }}</option>
                  @empty
                @endforelse
              </select>
            </div>
            @if ($selectedCategory)
              <div class="mb-3">
                <label class="text-[13px] leading-4 text-[#414d6a]">Tipo de trámite </label>
                <select wire:model="selectedTypeprocedure" name="typeprocedure_id" id="typeprocedure_id" class="w-full py-1.5 text-[13px] text-[#414d6a] leading-4 rounded-[3px] border-[#cdd5de] focus:border-inherit focus:ring-0" @required(true)>
                  <option value="">seleccione tipo de trámite</option>
                  @forelse ($typeprocedures as $typeprocedure)
                    <option value="{{ $typeprocedure->id }}">{{ $typeprocedure->name }}</option>
                    @empty
                  @endforelse
                </select>
              </div>
            @endif
            @if ($selectedTypeprocedure)
              <div class="mb-3">
                <label class="text-[13px] leading-4 text-[#414d6a]">Requisitos de trámite</label>
                <div class="bg-[#f1f3f6] p-3 grid md:grid-cols-3 gap-3">
                  @forelse ($requirements as $requirement)
                    <div class="col-span-3 md:col-span-1 border border-dashed border-[#d9d9da] transition duration-300 flex flex-row rounded-[3px] hover:border-[#0d8a72] ">
                      <input type="hidden" name="files[][id]" value="{{ $requirement->id }}">
                      <div class="px-4 inline-flex items-center border-r border-[#d9d9da] bg-white">
                        <span class="text-[13px] text-[#414d6a]">{{ $requirement->name }}</span>
                      </div>
                      <input name="files[][file]" id="files" class="cursor-pointer w-full flex text-[13px] text-center justify-center bg-white py-1.5 px-3.5 relative m-0 flex-auto duration-300 ease-in-out file:hidden focus:outline-none" type="file" accept="" ref="fileInput" @required(true)>
                    </div>
                    @empty
                    <div class="w-full border border-dashed border-[#d9d9da] transition duration-300 flex flex-row rounded-[3px]">
                      <div class="rounded-[3px] w-full flex py-1.5 justify-center">
                        <span class="text-[13px]">No hay requisitos</span>
                      </div>
                    </div>
                  @endforelse
                </div>
              </div>
            @endif
            <div class="mb-2" wire:ignore wire:key="descriptionId">
              <label class="text-[13px] leading-4 text-[#414d6a]">Descripción</label>
              <textarea type="text" name="description" placeholder="Descripción" class="w-full py-1.5 text-[13px] text-[#414d6a] leading-4 rounded-[3px] border-[#cdd5de] focus:border-inherit focus:ring-0"></textarea>
            </div>
            <button class="text-[#0d8a72] rounded-[3px] text-[13px] leading-4 items-center inline-flex gap-1 align-middle"><ion-icon name="add-outline" wire:ignore></ion-icon>Registrar</button>
          </form>
        </div>
      </div>
    </div>
    <div class="w-full md:w-1/3 lg:w-1/4">
      <div class="border border-[#cdd5de] bg-white rounded-[3px]">
        <div class="w-full flex justify-between items-center py-2 px-3 border-b border-[#cdd5de]">
          <span class="text-[13px] leading-4 text-[#414d6a]">Información de trámite</span>
        </div>
        <div class="w-full p-[12px]">
          <ul class="flex flex-col text-left gap-2.5 text-[#414d6a]">
            <li class="flex gap-x-3 overflow-hidden">
              <div class="text-[13px] items-center" wire:ignore>
                <ion-icon name="folder-open-outline"></ion-icon>
              </div>
              <p class="text-[13px]">
                <span class="pr-1">Categoría:</span>
                @if($selectedCategory) @if (!empty($categorydata[0]->description)) {{ $categorydata[0]->description }} @else <p> -- </p> @endif @else <p> -- </p> @endif
              <p>
            </li>
            <li class="flex gap-x-3 overflow-hidden">
              <div class="text-[14px] items-center" wire:ignore>
                <ion-icon name="clipboard-outline"></ion-icon>
              </div>
              <p class="text-[13px]">
                <span class="pr-1">Tipo de trámite:</span>
                @if($selectedTypeprocedure) @if (!empty($typeproceduredata[0]->description)) {{ $typeproceduredata[0]->description }} @else <p> -- </p> @endif @else <p> -- </p> @endif
              </p>
            </li>
            <li class="flex gap-x-3 overflow-hidden">
              <div class="text-[14px] items-center" wire:ignore>
                <ion-icon name="file-tray-outline"></ion-icon>
              </div>
              <p class="text-[13px]">
                <span class="pr-1">Área inicial:</span>
                @if($selectedTypeprocedure) @if (!empty($typeproceduredata[0]->area->description)) {{ $typeproceduredata[0]->area->description }} @else <p> -- </p> @endif @else <p> -- </p> @endif
              </p>
            </li>
            <li class="flex gap-x-3 overflow-hidden">
              <div class="text-[14px] items-center" wire:ignore>
                <ion-icon name="cash-outline"></ion-icon>
              </div>
              <p class="text-[13px]">
                <span class="pr-1">Precio:</span>
                @if($selectedTypeprocedure) @if (!empty($typeproceduredata[0]->price)) {{ $typeproceduredata[0]->price }} @else <p> -- </p> @endif @else <p> -- </p> @endif
              </p>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
