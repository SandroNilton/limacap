<div>
  <form wire:submit.prevent="store">
    <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
      <div class="col-span-2">
        <div class="bg-white bg-opacity-100 border-b border-opacity-100 rounded-md border-[rgb(229,231,235)] shadow p-4">
          <x-input-label class="mb-3"><ion-icon name="information-circle-outline" class="text-[#10B981] text-lg mr-2" wire:ignore></ion-icon> La contraseña debe contener de 8 a más carácteres con una combinación de letras, números, mayúsculas y símbolos.</x-input-label>
          <div class="mb-3">
            <x-input-label>Nombre <x-wire-loading /></x-input-label>
            <x-text-input wire:model="name" type="text" name="name" placeholder="Nombre"/>
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
          </div>
          <div class="mb-3">
            <x-input-label>Área</x-input-label>
            <x-select wire:model="area" name="state">
              <option value=""> Seleccione el área </option>
              @foreach ($areas as $area)
                <option value="{{ $area->id }}">{{ $area->name }}</option>
              @endforeach
            </x-select>
            <x-input-error :messages="$errors->get('area')" class="mt-2" />
          </div>
          <div class="mb-3">
            <x-input-label>Correo electronico</x-input-label>
            <x-text-input wire:model="email" type="text" name="email" placeholder="Correo electronico"/>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
          </div>
          <div class="mb-3">
            <x-input-label>Contraseña</x-input-label>
            <x-text-input wire:model="password" type="password" name="password" placeholder="Contraseña"/>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
          </div>
          <div class="mb-3">
            <x-input-label>Confirmación contraseña</x-input-label>
            <x-text-input wire:model="password_confirmation" type="password" name="password_confirmation" placeholder="Confirme contraseña"/>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
          </div>
          <div class="mb-3">
            <x-input-label>Estado</x-input-label>
            <x-select wire:model="state" name="state">
              <option value="Inactivo">Inactivo</option>
              <option value="Activo">Activo</option>
            </x-select>
          </div>
          <x-primary-button class="gap-2">
            <ion-icon name="add-circle-outline" class="text-lg" wire:ignore></ion-icon>Guardar
          </x-primary-button>
        </div>
      </div>
      <div class="col-span-1">
        <div class="bg-white bg-opacity-100 border-b border-opacity-100 rounded-md border-[rgb(229,231,235)] shadow p-4">
          <p class="text-md font-semibold text-[rgb(17,24,39)] text-opacity-100 mb-3">Roles</p>
          <div class="grid grid-cols-2 gap-3">
            @foreach ($roles as $rol)
              <div class="flex rounded-md border border-[#cdd5de] p-2 items-center space-x-3" wire:key="{{ $rol->id }}">
                {!! Form::checkbox('roles[]', $rol->id, null, ['class' => 'w-4 h-4 rounded-full font-semibold text-[#10B981] text-sm border-[#cdd5de] focus:ring-[#cdd5de]', 'wire:model.lazy="roles_val"']) !!}
                <label class="text-sm text-[rgb(17,24,39)] font-medium">{{ $rol->name }}</label>
              </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </form>
</div>



