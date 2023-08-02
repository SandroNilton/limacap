<div class="flex space-x-2">
  @can('admin.typeprocedures.edit')
    <a class="text-[#dcaa3f] px-2 rounded-[3px] text-[13px] items-center inline-flex gap-1" href="{{ route('admin.typeprocedures.edit', ['typeprocedure' => $value ]) }}">
      <ion-icon name="pencil-outline" wire:ignore></ion-icon> Editar
    </a>
  @endcan
  @can('admin.typeprocedures.destroy')
    <button wire:click="deleteTypeprocedure('{{ $value }}')" class="text-[#C83232] px-2 rounded-[3px] text-[13px] items-center inline-flex gap-1">
      <ion-icon name="trash-outline" wire:ignore></ion-icon> Eliminar
    </button>
  @endcan
</div>
