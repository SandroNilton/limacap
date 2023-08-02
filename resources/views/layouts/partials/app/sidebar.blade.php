<div x-on:click="toggleSidbarMenu()" x-show.in.out.opacity="isSidebarOpen" class="fixed inset-0 z-10 bg-black bg-opacity-20 lg:hidden" style="backdrop-filter: blur(14px); -webkit-backdrop-filter: blur(14px)"></div>
<aside x-transition:enter="transition transform duration-300" x-transition:enter-start="-translate-x-full opacity-30 ease-in" x-transition:enter-end="translate-x-0 opacity-100 ease-out" x-transition:leave="transition transform duration-300" x-transition:leave-start="translate-x-0 opacity-100 ease-out" x-transition:leave-end="-translate-x-full opacity-0 ease-in" class="fixed inset-y-0 z-10 flex flex-col flex-shrink-0 w-[180px] max-h-screen overflow-hidden transition-all transform bg-[#2d3446] shadow-lg lg:z-auto lg:static lg:shadow-none" :class="{'-translate-x-full lg:translate-x-0 lg:w-[41px]': !isSidebarOpen}">
  <div class="flex pr-[10px] pl-[10px] items-center flex-shrink-0 bg-[#0d8a72] justify-center" :class="{'lg:justify-center': !isSidebarOpen}">
    <span class="p-2 uppercase whitespace-nowrap text-white font-light">
      <a :class="{'lg:hidden': isSidebarOpen}" class="text-[12px] font-light tracking-[.19em]">C</a>
      <a :class="{'lg:hidden': !isSidebarOpen}" class="text-[12px] font-light tracking-[.19em]">CAP LIMA</a>
    </span>
  </div>
  <nav class="flex-1 overflow-hidden hover:overflow-y-auto bg-white border-r border-[#cdd5de]">
    <ul class="pt-[4px] pb-[4px] overflow-hidden">
      @foreach ($links as $link)
        <a id="{{ $link['id'] }}" href="{{ $link['url'] }}" x-init="new tippy(`#{{ $link['id'] }}`, { content: `{{ $link['title'] }}`, arrow: true, placement: 'right' })" class="flex content-center {{ $link['active'] ? 'text-[#0d8a72]' : 'text-[#414d6a]' }}" :class="{'justify-center': !isSidebarOpen}">
          <li class="w-full h-9 flex items-center {{ $link['active'] ? '' : '' }}" :class="{'pl-[24px]': isSidebarOpen, 'pl-[11px] pr-[11px] text-clip': !isSidebarOpen}">
            <span class="flex items-center content-center">
              <ion-icon name="{{ $link['icon'] }}" class="text-[14px] mr-[30px]"></ion-icon>
              <span class="text-xs" :class="{ 'lg:hidden': !isSidebarOpen }">{{ $link['title'] }}</span>
            </span>
          </li>
        </a>
      @endforeach
    </ul>
  </nav>
  <div class="flex pr-[10px] pl-[10px] items-center flex-shrink-0 justify-center bg-white border-r border-[#cdd5de]" :class="{'lg:justify-center': !isSidebarOpen}">
    <span class="p-2 uppercase whitespace-nowrap text-[#414d6a] font-light">
      <a :class="{'lg:hidden': isSidebarOpen}" class="text-[12px] font-light tracking-[.19em]">C</a>
      <a :class="{'lg:hidden': !isSidebarOpen}" class="text-[12px] font-light tracking-[.19em]">CAP LIMA</a>
    </span>
  </div>
</aside>
@push('js')
  <script>
    const setup = () => {
      return {
        loading: true,
        isSidebarOpen: false,
        toggleSidbarMenu() {
          this.isSidebarOpen = !this.isSidebarOpen
        },
        isSettingsPanelOpen: false,
        isSearchBoxOpen: false,
      }
    }
  </script>
@endpush
