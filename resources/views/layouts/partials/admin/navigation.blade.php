<nav class="flex-shrink-0 bg-[#0d8a72]">
  <div class="flex items-center h-[40px] justify-between pr-[5px] pl-[5px]">
    <div class="flex content-center space-x-3">
      <button @click="toggleSidbarMenu()" class="p-1.5 flex content-center">
        <ion-icon name="reorder-three-outline" class="text-[20px] text-white"></ion-icon>
      </button>
    </div>
    <div class="flex content-center space-x-3">
      <x-dropdown align="right" width="48">
        <x-slot name="trigger">
          <button class="inline-flex items-center px-2 py-2 border border-transparent text-[13px] leading-4 font-medium rounded-md dark:text-gray-400 bg-transparent text-white dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
            <div>{{ Auth::user()->name }}</div>
            <div class="ml-1">
              <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
              </svg>
            </div>
          </button>
        </x-slot>
        <x-slot name="content">
          @can('admin')
            <x-dropdown-link :href="route('app.index')">
              Usuario
            </x-dropdown-link>
          @endcan
          <x-dropdown-link :href="route('profile.edit')">
            {{ __('Mi perfil') }}
          </x-dropdown-link>
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
              {{ __('Cerrar sesión') }}
            </x-dropdown-link>
          </form>
        </x-slot>
      </x-dropdown>
    </div>
  </div>
</nav>
