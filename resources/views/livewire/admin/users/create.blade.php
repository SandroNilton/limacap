<div>
  <div class="flex justify-between items-center py-2 px-3 border-b border-[#cdd5de] bg-white">
    <span class="text-[#414d6a] text-[13px]">Nuevo usuario</span>
  </div>
  <form wire:submit.prevent="createUser" class="p-[12px] bg-[#f1f3f6] sm:flex gap-3">
    <div class="w-full md:w-2/3 lg:w-3/4 mb-4">
      <div class="border border-[#cdd5de] bg-white mb-4 rounded-[3px]">
        <div class="w-full flex justify-between items-center py-2 px-3 border-b border-[#cdd5de]">
          <span class="text-[13px] leading-4 text-[#414d6a]">Parametros de usuario</span>
        </div>
        <div class="w-full p-[12px]">
          <div class="mb-3">
            <input wire:model="name" type="text" name="name" placeholder="Nombre" class="w-full py-1.5 text-[13px] text-[#414d6a] leading-4 rounded-[3px] border-[#cdd5de] focus:border-inherit focus:ring-0 @if($errors->has('name')) border-[#d72d30] @endif"/>
            @error('name')
              <span class="text-xs scale-75 text-[#d72d30] mb-0 mt-0.5">{{ $message }}</strong>
            @enderror
          </div>
          <div class="mb-3">
            <input wire:model="email" type="email" name="email" placeholder="Correo electronico" class="w-full py-1.5 text-[13px] text-[#414d6a] leading-4 rounded-[3px] border-[#cdd5de] focus:border-inherit focus:ring-0 @if($errors->has('email')) border-[#d72d30] @endif"/>
            @error('email')
              <span class="text-xs scale-75 text-[#d72d30] mb-0 mt-0.5">{{ $message }}</strong>
            @enderror
          </div>
          <div class="mb-3">
            <select wire:model="area_id" name="area_id" class="w-full py-1.5 text-[13px] text-[#414d6a] leading-4 rounded-[3px] border-[#cdd5de] focus:border-inherit focus:ring-0 @if($errors->has('area_id')) border-[#d72d30] @endif">
              <option value=""> Seleccione el área </option>
              @foreach ($areas as $area)
                <option value="{{ $area->id }}">{{ $area->name }}</option>
              @endforeach
            </select>
            @error('area_id')
              <span class="text-xs scale-75 text-[#d72d30] mb-0 mt-0.5">{{ $message }}</strong>
            @enderror
          </div>
          <div class="mb-3">
            <input wire:model="password" type="password" name="password" pattern="^(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$" placeholder="Contraseña" class="w-full py-1.5 text-[13px] text-[#414d6a] leading-4 rounded-[3px] border-[#cdd5de] focus:border-inherit focus:ring-0 @if($errors->has('password')) border-[#d72d30] @endif"/>
            @error('password')
              <span class="text-xs scale-75 text-[#d72d30] mb-0 mt-0.5">{{ $message }}</strong>
            @enderror
          </div>
          <div class="mb-3">
            <input wire:model="password_confirmation" type="password" name="password_confirmation" pattern="^(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$" value="{{ old('password_confirmation') }}" placeholder="Confirma contraseña" class="w-full py-1.5 text-[13px] text-[#414d6a] leading-4 rounded-[3px] border-[#cdd5de] focus:border-inherit focus:ring-0 @if($errors->has('password_confirmation')) border-[#d72d30] @endif"/>
            @error('password_confirmation')
              <span class="text-xs scale-75 text-[#d72d30] mb-0 mt-0.5">{{ $message }}</strong>
            @enderror
          </div>
          <div class="mb-2">
            <select wire:model="state" name="state" class="w-full py-1.5 text-[13px] text-[#414d6a] leading-4 rounded-[3px] border-[#cdd5de] focus:border-inherit focus:ring-0">
              <option value="activo">Activo</option>
              <option value="inactivo">Inactivo</option>
            </select>
          </div>
          @can('admin.users.create')
            <div class="mb-2">
              <button type="submit" class="text-[#0d8a72] rounded-[3px] text-[13px] leading-4 items-center inline-flex gap-1 align-middle"><ion-icon name="add-outline" wire:ignore></ion-icon> Registrar</button>
            </div>
          @endcan
          <div class="text-[13px] items-center inline-flex gap-1 align-middle">
            <ion-icon name="information-outline" class="text-[#0d8a72]" wire:ignore></ion-icon>
            <span class="text-[#414d6a]">La contraseña debe contener de 8 a más carácteres con una combinación de letras, números, mayúsculas y símbolos.</span>
          </div>
        </div>
      </div>
    </div>
    <div class="w-full md:w-1/3 lg:w-1/4">
      <div class="border border-[#cdd5de] bg-white rounded-[3px]">
        <div class="w-full flex justify-between items-center py-2 px-3 border-b border-[#cdd5de]">
          <span class="text-[13px] leading-4 text-[#414d6a]">Roles de usuario</span>
        </div>
        <div class="w-full p-[12px]">
          @foreach ($roles as $rol)
            <div class="flex justify-start gap-3 items-center mb-2">
              {!! Form::checkbox('roles[]', $rol->id, null, ['class' => 'w-4 h-4 text-[#0d8a72] rounded-[3px] border border-[#cdd5de] accent-[#cdd5de] focus:accent-[#cdd5de] focus:ring-0', 'wire:model.lazy="roles_val"']) !!}
              <label class="text-[13px] text-[#414d6a] leading-4">{{ $rol->name }}</label>
            </div>
          @endforeach
        </div>
      </div>
    </div>
  </form>
</div>




