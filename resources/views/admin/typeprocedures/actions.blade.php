<div class="flex space-x-2">
  @can('admin.typeprocedures.edit')
    <a class="text-[#6B7280] inline-flex" href="{{ route('admin.typeprocedures.edit', ['typeprocedure' => $value ]) }}">
      <ion-icon name="settings-outline" class="text-lg" wire:ignore></ion-icon>
    </a>
  @endcan
</div>
