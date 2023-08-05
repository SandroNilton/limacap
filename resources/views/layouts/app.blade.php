<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <!-- Scripts -->
    <!-- Development -->
    <script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.min.js"></script>
    <script src="https://unpkg.com/tippy.js@6/dist/tippy-bundle.umd.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
  </head>
  <body class="font-sans antialiased">
    <livewire:laravel-notification.notice/>
    <div class="flex h-screen overflow-y-hidden bg-white" x-data="setup()" x-init="$refs.loading.classList.add('hidden')">
      @include('layouts.partials.app.loading')
      @php
        $links =  [
          [
            'id' => 'welcome',
            'title' => 'Inicio',
            'url' => route('app.index'),
            'active' => request()->routeIs('app.index'),
            'icon' => 'home-outline',
          ],
          [
            'id' => 'tramites',
            'title' => 'Crear trámite',
            'url' => route('app.procedures.index'),
            'active' => request()->routeIs('app.procedures.index') or request()->routeIs('app.procedures.create') or request()->routeIs('app.procedures.edit'),
            'icon' => 'document-outline',
          ]
        ];
      @endphp
      @include('layouts.partials.app.sidebar')
      <div class="flex flex-col flex-1 h-full overflow-hidden">
        @include('layouts.partials.app.navigation')
        <main class="flex-1 max-h-full overflow-hidden overflow-y-scroll bg-[#f1f3f6] scrollbar">
          {{ $slot }}
        </main>
        @include('layouts.partials.app.footer')
      </div>
    </div>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    @stack('js')
    @livewireScripts
  </body>
</html>
