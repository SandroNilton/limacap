<div>
  <div class="flex justify-between items-center py-2 px-3 border-b border-[#cdd5de] bg-white">
    <span class="text-[#414d6a] text-[13px]">Nuevo rol</span>
  </div>
  <form wire:submit.prevent="createRole" class="p-[12px] bg-[#f1f3f6] sm:flex gap-3">
    <div class="w-full">
      <div class="border border-[#cdd5de] bg-white mb-4 rounded-[3px]">
        <div class="w-full flex justify-between items-center py-2 px-3 border-b border-[#cdd5de]">
          <span class="text-[13px] leading-4 text-[#414d6a]">Parametros de rol</span>
        </div>
        <div class="w-full p-[12px]">
          <div class="mb-3">
            <input wire:model="name" type="text" name="name" placeholder="Nombre" class="w-full py-1.5 text-[13px] text-[#414d6a] leading-4 rounded-[3px] border-[#cdd5de] focus:border-inherit focus:ring-0 @if($errors->has('name')) border-[#d72d30] @endif"/>
            @error('name')
              <span class="px-3 text-xs scale-75 text-[#d72d30] mb-0 mt-0.5">{{ $message }}</strong>
            @enderror
          </div>
          <div class="mb-2">
            <div class="sm:flex-row md:flex md:flex-wrap gap-2">
              @foreach ($permissions as $permission)
                <div class="flex-auto justify-start items-center mb-1 px-2 py-1 border border-[#cdd5de] rounded-[3px]">
                  {!! Form::checkbox('permissions[]', $permission->id, null, ['class' => 'w-4 h-4 mr-1 text-[#0d8a72] rounded-[3px] border border-[#cdd5de] accent-[#cdd5de] focus:accent-[#cdd5de] focus:ring-0', 'wire:model.lazy="permissions_val"']) !!}
                  <label class="text-[13px] text-[#414d6a] leading-4">{{ $permission->description }}</label>
                </div>
              @endforeach
            </div>
          </div>
          @can('admin.roles.create')
            <div class="mb-1">
              <button type="submit" class="text-[#0d8a72] rounded-[3px] text-[13px] leading-4 items-center inline-flex gap-1 align-middle"><ion-icon name="add-outline" wire:ignore></ion-icon> Registrar</button>
            </div>
          @endcan
        </div>
      </div>
    </div>
  </form>
</div>




