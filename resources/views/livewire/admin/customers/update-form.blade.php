<div>
  <form wire:submit.prevent="update">
    <div class="mb-3">
      <x-input-label>Nombre <x-wire-loading /></x-input-label>
      <x-text-input wire:model="name" type="text" name="name" placeholder="Nombre" disabled/>
    </div>
    <div class="mb-3">
      <x-input-label>Correo electronico</x-input-label>
      <x-text-input wire:model="email" type="text" name="name" placeholder="Correo electronico" disabled/>
    </div>
    <div class="mb-3">
      <x-input-label>Estado</x-input-label>
      <x-select wire:model="state" name="state">
        <option value="0">Inactivo</option>
        <option value="1">Activo</option>
      </x-select>
    </div>
    <div class="flex gap-3">
      @can('admin.requirements.edit')
        <x-primary-button class="gap-2">
          <ion-icon name="add-circle-outline" class="text-lg" wire:ignore></ion-icon>Guardar
        </x-primary-button>
      @endcan
    </div>
  </form>  
</div>






