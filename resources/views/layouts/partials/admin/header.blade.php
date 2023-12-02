<header x-data="{ isOpen: false }" class="sticky top-0 z-30 w-full antialiased bg-white border-b border-b-[rgb(229,231,235)] border-opacity-100">
  <nav class="px-4 py-2 bg-white bg-opacity-100 shadow lg:px-6">
    <div class="flex flex-wrap items-center justify-between">
      <div class="flex items-center justify-start">
        <a href="{{ route('app.index') }}" class="flex mr-4">
          <img src="https://limacap.org/wp-content/uploads/2023/03/CAP_logocolores-black.png" class="w-full h-8">
        </a>
      </div>
      <div class="flex items-center space-x-1 lg:order-2">
        <button class="text-opacity-100 p-2 inline-flex items-center rounded-full text-[#6B7280] hover:bg-[#F2F2F2] hover:text-[rgb(17,27,39)]">
          <ion-icon name="sunny-outline" class="text-xl leading-0"></ion-icon>
        </button>
        <button class="text-opacity-100 p-2 inline-flex items-center rounded-full text-[#6B7280] hover:bg-[#F2F2F2] hover:text-[rgb(17,27,39)]">
          <ion-icon name="notifications-outline" class="text-xl leading-0"></ion-icon>
        </button>
        <x-dropdown align="right" width="48">
          <x-slot name="trigger">
            <button class="inline-flex items-center p-2 border border-transparent text-sm text-[#6B7280] hover:bg-[#F2F2F2] hover:text-[rgb(17,27,39)] font-medium rounded-md bg-transparent transition ease-in-out duration-150">
              <div>{{ Auth::user()->name }}</div>
              <div class="ml-1">
                <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
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
            <x-dropdown-link :href="route('admin.profile.edit')">
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
        <!-- Mobile menu button -->
        <div class="flex md:hidden">
          <button @click="isOpen = !isOpen" type="button" class="flex text-opacity-100 p-2 inline-flex items-center rounded-full text-[#6B7280] hover:bg-[#F2F2F2] hover:text-[rgb(17,27,39)]">
            <ion-icon name="menu-outline" class="text-xl leading-0"></ion-icon>
          </button>
        </div>
      </div>
    </div>
  </nav>

  <nav class="md:flex" :class="isOpen ? 'block' : 'hidden'">
    <div class="px-0 lg:py-2 lg:px-6">
      <div class="flex items-center">
        <span class="flex flex-col md:flex-row items-center w-full overflow-y-auto whitespace-no-wrap scroll-hidden">
          @foreach ($links as $link)
            <div class="rounded-md flex lg:inline hover:bg-[rgb(243,244,246)] bg-opacity-100 text-[rgb(75,85,99)] text-opacity-100 pointer py-2 md:py-0 md:border-b-0 border-opacity-100 w-full md:w-auto">
              <a href="{{ $link['url'] }}" class="flex items-center gap-2 px-3 py-1.5">
                <ion-icon class="text-lg" name="{{  $link['icon']  }}"></ion-icon>
                <span class="text-sm font-medium">{{ $link['title'] }}</span>
              </a>
            </div>
          @endforeach
        </span>
      </div>
    </div>
  </nav>
  
</header>
