<div>
    {{-- Success is as dangerous as failure. --}}




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
