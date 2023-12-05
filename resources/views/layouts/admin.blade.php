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
          'url' => route('admin.index'),
          'active' => request()->routeIs('admin.index'),
          'icon' => 'home-outline',
          'can' => 'admin.dashboard.index'
        ],
        [
          'title' => 'Trámites',
          'url' => route('admin.procedures.index'),
          'active' => request()->routeIs('admin.procedures.index') or request()->routeIs('admin.procedures.edit'),
          'icon' => 'document-text-outline',
          'can' => 'admin.procedures.index'
        ],
        [
          'title' => 'Usuarios',
          'url' => route('admin.users.index'),
          'active' => request()->routeIs('admin.users.index') or request()->routeIs('admin.users.create') or request()->routeIs('admin.users.edit'),
          'icon' => 'people-outline',
          'can' => 'admin.users.index'
        ],
        [
          'title' => 'Clientes',
          'url' => route('admin.customers.index'),
          'active' => request()->routeIs('admin.customers.index') or request()->routeIs('admin.customers.create') or request()->routeIs('admin.customers.edit'),
          'icon' => 'body-outline',
          'can' => 'admin.customers.index'
        ],
        [
          'title' => 'Roles',
          'url' => route('admin.roles.index'),
          'active' => request()->routeIs('admin.roles.index') or request()->routeIs('admin.roles.create') or request()->routeIs('admin.roles.edit'),
          'icon' => 'shield-outline',
          'can' => 'admin.roles.index'
        ],
        [
          'title' => 'Categorias',
          'url' => route('admin.categories.index'),
          'active' => request()->routeIs('admin.categories.index') or request()->routeIs('admin.categories.create') or request()->routeIs('admin.categories.edit'),
          'icon' => 'folder-outline',
          'can' => 'admin.categories.index'
        ],
        [
          'title' => 'Areas',
          'url' => route('admin.areas.index'),
          'active' => request()->routeIs('admin.areas.index') or request()->routeIs('admin.areas.create') or request()->routeIs('admin.areas.edit'),
          'icon' => 'file-tray-outline',
          'can' => 'admin.areas.index'
        ],
        [
          'title' => 'Requisitos',
          'url' => route('admin.requirements.index'),
          'active' => request()->routeIs('admin.requirements.index') or request()->routeIs('admin.requirements.create') or request()->routeIs('admin.requirements.edit'),
          'icon' => 'attach-outline',
          'can' => 'admin.requirements.index'
        ],
        [
          'title' => 'Tipos de tramite',
          'url' => route('admin.typeprocedures.index'),
          'active' => request()->routeIs('admin.typeprocedures.index') or request()->routeIs('admin.typeprocedures.create') or request()->routeIs('admin.typeprocedures.edit'),
          'icon' => 'briefcase-outline',
          'can' => 'admin.typeprocedures.index'
        ]
      ];
    @endphp
    <livewire:laravel-notification.notice/>
    <div class="flex flex-col flex-auto font-sans">
      <div class="flex flex-auto min-w-0">
        <div class="relative flex flex-col flex-auto w-full min-w-0">
          @include('layouts.partials.admin.header')
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
    @livewireChartsScripts
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    @stack('js')
    @livewireScripts
  </body>
</html>
