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
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    @stack('css')
  </head>
  <body class="bg-[rgb(243,244,246)] antialiased text-[rgb(107,114,128)] text-opacity-100 bg-opacity-100 font-inter">
    @php
        $links =  [
          [
            'title' => 'Inicio',
            'url' => route('app.index'),
            'active' => request()->routeIs('app.index'),
            'icon' => 'home-outline',
          ],
          [
            'title' => 'Crear trámite',
            'url' => route('app.procedures.index'),
            'active' => request()->routeIs('app.procedures.index') or request()->routeIs('app.procedures.create') or request()->routeIs('app.procedures.edit'),
            'icon' => 'document-outline',
          ]
        ];
      @endphp
    <livewire:laravel-notification.notice/>
    <div class="flex flex-col flex-auto font-sans">
      <div class="flex flex-auto min-w-0">
        <div class="relative flex flex-col flex-auto w-full min-w-0">
          @include('layouts.partials.app.header')
          <div class="flex flex-col justify-between flex-auto h-full">
            <main class="h-full">
              <div class="relative flex flex-col flex-auto h-full px-4 py-4 mx-auto page-container sm:px-6 md:px-6 sm:py-4">
                {{ $slot }}
              </div>
            </main>
          </div>
        </div>
      </div>
    </div> 
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    @stack('js')
    @livewireScripts
  </body>
</html>
