<div class="flex space-x-2">
  @can('admin.customers.edit')
    <a class="text-[#dcaa3f] px-2 rounded-[3px] text-[13px] items-center inline-flex gap-1" href="{{ route('admin.customers.edit', ['customer' => $value ]) }}">
      <ion-icon name="pencil-outline" wire:ignore></ion-icon> Editar
    </a>
  @endcan
</div>
