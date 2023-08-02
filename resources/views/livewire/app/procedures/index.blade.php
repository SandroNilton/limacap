<div>
  <div class="flex justify-between items-center py-2 px-2.5 border-b border-[#cdd5de] bg-white">
    <span class="text-[#414d6a] text-[13px]">Mis trámites</span>
    <a href="{{ route('app.procedures.create') }}" class="text-[#0d8a72] text-[13px] items-center inline-flex gap-1">
      <ion-icon name="add-outline" wire:ignore></ion-icon>  Nuevo
    </a>
  </div>
  <div class="p-[12px] bg-[#f1f3f6] flow-root">
    <div class="col-span-4 md:col-span-3 border border-[#cdd5de] bg-white rounded-[3px]">
      <div class="w-full flex justify-between items-center py-2 px-2.5 border-b border-[#cdd5de]">
        <span class="text-[13px] leading-4 text-[#414d6a]">Lista de trámites</span>
      </div>
      <div class="w-full p-[12px]">
        <livewire:app.procedures.procedure-table />
      </div>
    </div>
  </div>
</div>

