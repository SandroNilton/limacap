<div class="flex space-x-2">
  @can('admin.areas.edit')
    <a class="text-[#dcaa3f] px-2 rounded-[3px] text-[13px] items-center inline-flex gap-1" href="{{ route('admin.areas.edit', ['area' => $value ]) }}">
      <ion-icon name="pencil-outline" wire:ignore></ion-icon> Editar
    </a>
  @endcan
  @can('admin.areas.destroy')
    <button wire:click="deleteArea('{{ $value }}')" class="text-[#C83232] px-2 rounded-[3px] text-[13px] items-center inline-flex gap-1">
      <ion-icon name="trash-outline" wire:ignore></ion-icon> Eliminar
    </button>
  @endcan
</div>
