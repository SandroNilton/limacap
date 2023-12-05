<div class="flex space-x-2">
  @can('admin.users.edit')
    <a class="text-[#6B7280] inline-flex" href="{{ route('admin.users.edit', ['user' => $value ]) }}">
      <ion-icon name="settings-outline" class="text-lg" wire:ignore></ion-icon>
    </a>
  @endcan
</div>
