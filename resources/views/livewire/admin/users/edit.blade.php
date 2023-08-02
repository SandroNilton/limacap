<div>
  <div class="flex justify-between items-center py-2 px-3 border-b border-[#cdd5de] bg-white">
    <span class="text-[#414d6a] text-[13px]">Editar usuario</span>
    @can('admin.users.destroy')
      <button wire:click="deleteUser({{ $user }})" class="text-[#C83232] px-2 rounded-[3px] text-[13px] items-center inline-flex gap-1">
        <ion-icon name="trash-outline" wire:ignore></ion-icon> Eliminar
      </button>
    @endcan
  </div>
  <form wire:submit.prevent="updateUser" class="p-[12px] bg-[#f1f3f6] sm:flex gap-3">
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
          <div class="mb-2">
            <select wire:model="state" name="state" class="w-full py-1.5 text-[13px] text-[#414d6a] leading-4 rounded-[3px] border-[#cdd5de] focus:border-inherit focus:ring-0">
              <option value="activo">Activo</option>
              <option value="inactivo">Inactivo</option>
            </select>
          </div>
          @can('admin.users.edit')
            <div>
              <button type="submit" class="text-[#0d8a72] text-[13px] leading-4 items-center inline-flex gap-1 align-middle"><ion-icon name="pencil-outline" wire:ignore></ion-icon> Editar</button>
            </div>
          @endcan
        </div>
      </div>
    </div>
    <div class="w-full md:w-1/3 lg:w-1/4">
      <div class="border border-[#cdd5de] bg-white rounded-[3px]">
        <div class="w-full flex justify-between items-center py-2 px-2.5 border-b border-[#cdd5de]">
          <span class="text-[13px] leading-4 text-[#414d6a]">Roles de usuario</span>
        </div>
        <div class="w-full p-[12px]">
          @forelse($roles as $role)
            <div class="flex justify-start gap-3 items-center mb-2">
              <input class="rounded-[3px] text-[#0d8a72] appearance-none checked-hover:bg-[#0d8a72] border-[#cdd5de] focus:border-inherit accent-[#cdd5de] focus:accent-[#cdd5de] focus:ring-0" id="role-{{$role->name}}" type="checkbox" value="{{$role->id}}" wire:model.lazy="roles_val" />
              <label class="text-[13px] text-[#414d6a] leading-4" for="role-{{$role->name}}">{{$role->name}}</label>
            </div>
            @empty
          @endforelse
        </div>
      </div>
    </div>
  </form>
</div>




