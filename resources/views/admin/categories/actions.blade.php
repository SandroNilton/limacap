<div class="flex space-x-2">
  @can('admin.categories.edit')
    <a class="text-[#6B7280] inline-flex" href="{{ route('admin.categories.edit', ['category' => $value ]) }}">
      <ion-icon name="settings-outline" class="text-lg" wire:ignore></ion-icon>
    </a>
  @endcan
</div>
