<div>
  <form wire:submit.prevent="update">
    <div class="mb-3">
      <x-input-label>Nombre <x-wire-loading /></x-input-label>
      <x-text-input wire:model="name" type="text" name="name" placeholder="Nombre"/>
      <x-input-error :messages="$errors->get('name')" class="mt-2" />
    </div>
    <div class="mb-3">
      <x-input-label>Descripción</x-input-label>
      <x-text-area wire:model="description" name="description" placeholder="Descripción" rows="4"></x-text-area>
    </div>
    <div class="mb-3">
      <x-input-label>Estado</x-input-label>
      <x-select wire:model="state" name="state">
        <option value="Inactivo">Inactivo</option>
        <option value="Activo">Activo</option>
      </x-select>
    </div>
    <div class="flex gap-3">
      @can('admin.categories.edit')
        <x-primary-button class="gap-2">
          <ion-icon name="add-circle-outline" class="text-lg" wire:ignore></ion-icon>Guardar
        </x-primary-button>
      @endcan
      @can('admin.categories.destroy')
        <x-danger-button type="button" wire:click="destroy({{ $category }})" class="gap-2">
          <ion-icon name="trash-outline" class="text-lg" wire:ignore></ion-icon>Eliminar
        </x-danger-button>
      @endcan
    </div>
  </form>
</div>




