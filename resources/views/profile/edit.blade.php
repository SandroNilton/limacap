<x-app-layout>
  <div>
    <header class="flex justify-between items-center py-2.5 px-2.5 border-b border-[#cdd5de] bg-white">
      <span class="text-[#414d6a] text-xs">Clientes</span>
    </header>
    <div class="p-[12px] bg-[#f1f3f6] flow-root">
      <div class="col-span-4 md:col-span-3 border border-[#cdd5de] bg-white rounded-[3px]">
        <div class="w-full flex justify-between items-center py-2 px-2.5 border-b border-[#cdd5de]">
          <span class="text-xs text-[#414d6a]">Lista de clientes</span>
        </div>
        <div class="w-full p-[12px]">
          @include('profile.partials.update-profile-information-form')
          @include('profile.partials.update-password-form')
          @include('profile.partials.delete-user-form')
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
