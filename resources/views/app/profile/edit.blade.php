<x-admin-layout>
  <div class="w-full h-full">
    <div class="flex flex-col h-full gap-4">
      <div class="flex items-center justify-between">
        <p class="text-md font-semibold text-[rgb(17,24,39)] text-opacity-100">Información de perfil</p>
      </div>
      <div class="grid-cols-3 grid gap-6">
        <div>
          <div class="bg-white bg-opacity-100 border-b border-opacity-100 rounded-md border-[rgb(229,231,235)] shadow p-4">
            @include('app.profile.partials.update-profile-information-form')
          </div>
        </div>
        <div>
          <div class="bg-white bg-opacity-100 border-b border-opacity-100 rounded-md border-[rgb(229,231,235)] shadow p-4">
            @include('app.profile.partials.update-password-form')
          </div>
        </div>
        <div>
          <div class="bg-white bg-opacity-100 border-b border-opacity-100 rounded-md border-[rgb(229,231,235)] shadow p-4">
            @include('app.profile.partials.delete-user-form')
          </div>
        </div>
      </div>
    </div>
  </div>
</x-admin-layout>