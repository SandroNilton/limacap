<div>
  <div class="flex justify-between mb-5">
    <h4 class=" text-base text-opacity-100 text-[rgb(17,24,39)] font-semibold">Detalles</h4>
    <a wire:click="$refresh" class="flex items-center gap-2 cursor-pointer transition hover:text-[#10B981] ease-in-out duration-300 text-lg text-[rgb(17,24,39)] font-medium">
      <x-wire-loading class="w-8 h-8"/>
      <ion-icon name="refresh-outline" wire:ignore></ion-icon>
    </a>
  </div>
  <span class="flex items-center gap-3 mb-3 text-emerald-500">
    <ion-icon name="hourglass-outline" class="text-lg" wire:ignore></ion-icon>
    <span class="text-sm font-medium">{{ $procedure->status }}</span>
  </span>
  <span class="flex items-center gap-3 mb-3">
    <ion-icon name="people-outline" class="text-lg" wire:ignore></ion-icon>
    <span class="text-sm font-medium">Clase: {{ $procedure->user->class }}</span>
  </span>
  <span class="flex items-center gap-3 mb-3">
    <ion-icon name="person-outline" class="text-lg" wire:ignore></ion-icon>
    <span class="text-sm font-medium">Nombre: {{ $procedure->user->name }}</span>
  </span>
  <span class="flex items-center gap-3 mb-3">
    <ion-icon name="folder-outline" class="text-lg" wire:ignore></ion-icon>
    <span class="text-sm font-medium">Categoría: {{ $procedure->typeprocedure->category->name }}</span>
  </span>
  <span class="flex items-center gap-3 mb-3">
    <ion-icon name="file-tray-outline" class="text-lg" wire:ignore></ion-icon>
    <span class="text-sm font-medium">Área: {{ $procedure->area->name }}</span>
  </span>
  <span class="flex items-center gap-3 mb-3">
    <ion-icon name="briefcase-outline" class="text-lg" wire:ignore></ion-icon>
    <span class="text-sm font-medium">Tipo: {{ $procedure->typeprocedure->name }}</span>
  </span>
  <span class="flex items-center gap-3 mb-3">
    <ion-icon name="chatbox-ellipses-outline" class="text-lg" wire:ignore></ion-icon>
    <span class="text-sm font-medium">Descripción: {{ $procedure->description }}</span>
  </span>
  <span class="flex items-center gap-3 mb-3">
    <ion-icon name="calendar-clear-outline" class="text-lg" wire:ignore></ion-icon>
    <span class="text-sm font-medium">Creado: {{ $procedure->created_at->format('d/m/Y h:i a') }}</span>
  </span>
</div>

