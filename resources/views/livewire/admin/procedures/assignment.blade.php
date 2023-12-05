<div>
  <div class="flex justify-between mb-5">
    <h4 class="text-opacity-100 text-[rgb(17,24,39)] font-semibold">Control</h4>
    <a wire:click="$refresh" class="flex items-center gap-2 cursor-pointer transition hover:text-[#10B981] ease-in-out duration-300 text-lg text-[rgb(17,24,39)] font-medium">
      <x-wire-loading class="w-8 h-8"/>
      <ion-icon name="refresh-outline" wire:ignore></ion-icon>
    </a>
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