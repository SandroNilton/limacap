<div class="flex space-x-2">
  @can('admin.users.edit')
    <a class="text-[#dcaa3f] px-2 rounded-[3px] text-[13px] items-center inline-flex gap-1" href="{{ route('admin.users.edit', ['user' => $value ]) }}">
      <ion-icon name="pencil-outline" wire:ignore></ion-icon> Editar
    </a>
  @endcan
  @can('admin.users.destroy')
    <button wire:click="deleteUser('{{ $value }}')" class="text-[#C83232] px-2 rounded-[3px] text-[13px] items-center inline-flex gap-1">
      <ion-icon name="trash-outline" wire:ignore></ion-icon> Eliminar
    </button>
  @endcan
</div>
