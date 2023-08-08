<div>
  <div class="flex justify-between items-center py-2 px-3 border-b border-[#cdd5de] bg-white">
    <span class="text-[#414d6a] text-[13px]">Editar cliente</span>
  </div>
  <form wire:submit.prevent="updateCustomer" class="p-[12px] bg-[#f1f3f6] sm:flex gap-3">
    <div class="w-full mb-3">
      <div class="border border-[#cdd5de] bg-white mb-4 rounded-[3px]">
        <div class="w-full flex justify-between items-center py-2 px-2.5 border-b border-[#cdd5de]">
          <span class="text-[13px] leading-4 text-[#414d6a]">Parametros de cliente</span>
        </div>
        <div class="w-full p-[12px]">
          <div class="mb-1">
            <label for="" class="text-[13px] leading-4 text-[#414d6a]">Nombre: {{ $this->name }}</label>
          </div>
          <div class="mb-2.5">
            <label for="" class="text-[13px] leading-4 text-[#414d6a]">Correo: {{ $this->email }}</label>
          </div>
          <div class="mb-2">
            <select wire:model="state" name="state" class="w-full py-1.5 text-[13px] leading-4 rounded-[3px] border-[#cdd5de] focus:border-inherit focus:ring-0">
              <option value="activo">Activo</option>
              <option value="inactivo">Inactivo</option>
            </select>
          </div>
          @can('admin.customers.edit')
            <div>
              <button type="submit" class="text-[#0d8a72] text-[13px] leading-4 items-center inline-flex gap-1 align-middle"><ion-icon name="pencil-outline" wire:ignore></ion-icon> Guardar</button>
            </div>
          @endcan
        </div>
      </div>
    </div>
  </form>
</div>




