<div>
  <div class="flex justify-between items-center py-2 px-3 border-b border-[#cdd5de] bg-white">
    <span class="text-[#414d6a] text-[13px]">Requisitos</span>
    @can('admin.requirements.create')
      <a href="{{ route('admin.requirements.create') }}" class="text-[#0d8a72] text-[13px] items-center inline-flex gap-1">
        <ion-icon name="add-outline" wire:ignore></ion-icon> Nuevo
      </a>
    @endcan
  </div>
  <div class="p-[12px] bg-[#f1f3f6] flow-root">
    <div class="col-span-4 md:col-span-3 border border-[#cdd5de] bg-white rounded-[3px]">
      <div class="w-full flex justify-between items-center py-2 px-3 border-b border-[#cdd5de]">
        <span class="text-[13px] leading-4 text-[#414d6a]">Lista de requisitos</span>
      </div>
      <div class="w-full p-[12px]">
        <livewire:admin.requirements.requirement-table />
      </div>
    </div>
  </div>
</div>

