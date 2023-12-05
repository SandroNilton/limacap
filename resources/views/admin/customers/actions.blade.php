<div class="flex space-x-2">
  @can('admin.customers.edit')
    <a class="text-[#6B7280] inline-flex" href="{{ route('admin.customers.edit', ['customer' => $value ]) }}">
      <ion-icon name="settings-outline" class="text-lg" wire:ignore></ion-icon>
    </a>
  @endcan
</div>
