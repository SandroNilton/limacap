<div>
  <form wire:submit.prevent="store">
    <div class="mb-3">
      <x-input-label>Nombre</x-input-label>
      <x-text-input wire:model="name" type="text" name="name" placeholder="Nombre"/>
      <x-input-error :messages="$errors->get('name')" class="mt-2" />
    </div>
    <div class="mb-3">
      <x-input-label>Descripción</x-input-label>
      <x-text-area wire:model="description" type="text" name="description" placeholder="Descripción" rows="4"></x-text-area>
    </div>
    <div class="mb-3">
      <x-input-label>Estado</x-input-label>
      <x-select wire:model="state" name="state">
        <option value="0">Inactivo</option>
        <option value="1">Activo</option>
      </x-select>
    </div>
    <x-primary-button class="gap-2">
      <ion-icon name="add-circle-outline" class="text-lg" wire:ignore></ion-icon>Guardar
    </x-primary-button>
  </form>
</div>