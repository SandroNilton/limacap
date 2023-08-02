<div>
  <div class="flex justify-between items-center py-2 px-2.5 border-b border-[#cdd5de] bg-white">
    <span class="text-[#414d6a] text-[13px]">Panel avanzado</span>
  </div>
  <div class="p-[14px] bg-[#f1f3f6]">
    <div class="sm:flex gap-3">
      <div class="w-full md:w-1/2 lg:w-3/4 mb-3">
        <div class="border border-[#cdd5de] bg-white rounded-[3px]">
          <div class="w-full flex justify-between items-center py-2 px-2.5 border-b border-[#cdd5de]">
            <span class="text-[13px] text-[#414d6a]">Trámites por estados</span>
          </div>
          <div class="w-full p-[12px]" style="height: 15rem;">
            <livewire:livewire-column-chart :column-chart-model="$columnChartModel" />
          </div>
        </div>
      </div>
      <div class="w-full md:w-1/2 lg:w-1/4 mb-3">
        <div class="border border-[#cdd5de] bg-white rounded-[3px]">
          <div class="w-full flex justify-between items-center py-2 px-2.5 border-b border-[#cdd5de]">
            <span class="text-[13px] text-[#414d6a]">Trámites por área</span>
          </div>
          <div class="w-full p-[12px]" style="height: 15rem;">
            <livewire:livewire-pie-chart key="{{ $pieChartModel->reactiveKey() }}" :pie-chart-model="$pieChartModel"/>
          </div>
        </div>
      </div>
    </div>

    <div class="sm:flex gap-3">
      <div class="w-full md:w-1/2 lg:w-3/4">
        <div class="border border-[#cdd5de] bg-white rounded-[3px]">
          <div class="w-full flex justify-between items-center py-2 px-2.5 border-b border-[#cdd5de]">
            <span class="text-[13px] text-[#414d6a]">Trámites por estados</span>
          </div>
          <div class="w-full p-[12px]" style="height: 15rem;">
            <livewire:livewire-column-chart :column-chart-model="$columnChartModel" />
          </div>
        </div>
      </div>
      <div class="w-full md:w-1/2 lg:w-1/4">
        <div class="border border-[#cdd5de] bg-white rounded-[3px]">
          <div class="w-full flex justify-between items-center py-2 px-2.5 border-b border-[#cdd5de]">
            <span class="text-[13px] text-[#414d6a]">Trámites por área</span>
          </div>
          <div class="w-full p-[12px]" style="height: 15rem;">
            <livewire:livewire-pie-chart key="{{ $pieChartModel->reactiveKey() }}" :pie-chart-model="$pieChartModel"/>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

