<div>
  <div class="flex justify-between items-center py-2 px-3 border-b border-[#cdd5de] bg-white">
    <span class="text-[#414d6a] text-[13px]">Editar área</span>
    @can('admin.areas.destroy')
      <button wire:click="deleteArea({{ $area }})" class="text-[#C83232] px-2 rounded-[3px] text-[13px] items-center inline-flex gap-1">
        <ion-icon name="trash-outline" wire:ignore></ion-icon> Eliminar
      </button>
    @endcan
  </div>
  <form wire:submit.prevent="updateArea" class="p-[12px] bg-[#f1f3f6] sm:flex gap-3">
    <div class="w-full mb-3">
      <div class="border border-[#cdd5de] bg-white mb-4 rounded-[3px]">
        <div class="w-full flex justify-between items-center py-2 px-3 border-b border-[#cdd5de]">
          <span class="text-[13px] text-[#414d6a] leading-4">Parametros de área</span>
        </div>
        <div class="w-full p-[12px]">
          <div class="mb-3">
            <input wire:model="name" type="text" name="name" placeholder="Nombre" class="w-full py-1.5 text-[13px] text-[#414d6a] leading-4 rounded-[3px] border-[#cdd5de] focus:border-inherit focus:ring-0 @if($errors->has('name')) border-[#d72d30] @endif"/>
            @error('name')
              <span class="px-3 text-xs scale-75 text-[#d72d30] mb-0 mt-0.5">{{ $message }}</strong>
            @enderror
          </div>
          <div class="mb-2">
            <textarea wire:model="description" type="text" name="description" placeholder="Descripción" class="w-full py-1.5 text-[13px] text-[#414d6a] leading-4 rounded-[3px] border-[#cdd5de] focus:border-inherit focus:ring-0"></textarea>
          </div>
          <div class="mb-3">
            <select wire:model="state" name="state" class="w-full py-1.5 text-[13px] text-[#414d6a] leading-4 rounded-[3px] border-[#cdd5de] focus:border-inherit focus:ring-0">
              <option value="activo">Activo</option>
              <option value="inactivo">Inactivo</option>
            </select>
          </div>
          @can('admin.areas.edit')
            <div>
              <button type="submit" class="text-[#0d8a72] text-[13px] leading-4 items-center inline-flex gap-1 align-middle"><ion-icon name="pencil-outline" wire:ignore></ion-icon> Guardar</button>
            </div>
          @endcan
        </div>
      </div>
    </div>
  </form>
</div>








