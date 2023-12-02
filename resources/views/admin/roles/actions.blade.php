<div class="flex space-x-2">
  @can('admin.roles.edit')
    <a class="text-[#6B7280] inline-flex" href="{{ route('admin.roles.edit', ['role' => $value ]) }}">
      <ion-icon name="settings-outline" class="text-lg" wire:ignore></ion-icon>
    </a>
  @endcan
</div>
