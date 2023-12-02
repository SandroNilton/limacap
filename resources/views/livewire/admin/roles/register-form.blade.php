<div>
  <form wire:submit.prevent="store">
    <div class="mb-3">
      <x-input-label>Nombre <x-wire-loading /></x-input-label>
      <x-text-input wire:model="name" type="text" name="name" placeholder="Nombre"/>
      <x-input-error :messages="$errors->get('name')" class="mt-2" />
    </div>
    <div class="mb-3">
      <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-3">
        @foreach ($permissions as $permission)
          <div class="flex rounded-md border border-[#cdd5de] rounded-[3px] p-3 space-x-3" wire:key="{{ $permission->id }}">
            {!! Form::checkbox('permissions[]', $permission->id, null, ['class' => 'w-4 h-4 rounded-full font-semibold text-[#10B981] text-sm border-[#cdd5de] focus:ring-[#cdd5de]', 'wire:model.lazy="permissions_val"']) !!}
            <label class="text-sm text-[rgb(17,24,39)] font-medium">{{ $permission->description }}</label>
          </div>
        @endforeach
      </div>
    </div>
    <x-primary-button class="gap-2">
      <ion-icon name="add-circle-outline" class="text-lg" wire:ignore></ion-icon>Guardar
    </x-primary-button>
  </form>
</div>



