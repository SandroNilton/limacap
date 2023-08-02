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
    <!-- Production -->
    <!--<script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://unpkg.com/tippy.js@6"></script>-->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    @stack('css')
  </head>
  <body class="font-sans antialiased">
    <livewire:laravel-notification.notice/>
    <div class="flex h-screen overflow-y-hidden bg-white" x-data="setup()" x-init="$refs.loading.classList.add('hidden')">
      @include('layouts.partials.admin.loading')
      @php
        $links =  [
          [
            'id' => 'panel-avanzado',
            'title' => 'Panel avanzado',
            'url' => route('admin.advanced-index'),
            'active' => request()->routeIs('admin.advanced-index'),
            'icon' => 'cellular-outline',
            'can' => 'admin.dashboard.index'
          ],
          [
            'id' => 'tramites',
            'title' => 'Trámites',
            'url' => route('admin.procedures.index'),
            'active' => request()->routeIs('admin.procedures.index') or request()->routeIs('admin.procedures.edit'),
            'icon' => 'document-text-outline',
            'can' => 'admin.procedures.index'
          ],
          [
            'id' => 'usuarios',
            'title' => 'Usuarios',
            'url' => route('admin.users.index'),
            'active' => request()->routeIs('admin.users.index') or request()->routeIs('admin.users.create') or request()->routeIs('admin.users.edit'),
            'icon' => 'people-outline',
            'can' => 'admin.users.index'
          ],
          [
            'id' => 'clientes',
            'title' => 'Clientes',
            'url' => route('admin.customers.index'),
            'active' => request()->routeIs('admin.customers.index') or request()->routeIs('admin.customers.create') or request()->routeIs('admin.customers.edit'),
            'icon' => 'body-outline',
            'can' => 'admin.customers.index'
          ],
          [
            'id' => 'roles',
            'title' => 'Roles',
            'url' => route('admin.roles.index'),
            'active' => request()->routeIs('admin.roles.index') or request()->routeIs('admin.roles.create') or request()->routeIs('admin.roles.edit'),
            'icon' => 'shield-outline',
            'can' => 'admin.roles.index'
          ],
          [
            'id' => 'categorias',
            'title' => 'Categorias',
            'url' => route('admin.categories.index'),
            'active' => request()->routeIs('admin.categories.index') or request()->routeIs('admin.categories.create') or request()->routeIs('admin.categories.edit'),
            'icon' => 'folder-outline',
            'can' => 'admin.categories.index'
          ],
          [
            'id' => 'areas',
            'title' => 'Areas',
            'url' => route('admin.areas.index'),
            'active' => request()->routeIs('admin.areas.index') or request()->routeIs('admin.areas.create') or request()->routeIs('admin.areas.edit'),
            'icon' => 'file-tray-outline',
            'can' => 'admin.areas.index'
          ],
          [
            'id' => 'requisitos',
            'title' => 'Requisitos',
            'url' => route('admin.requirements.index'),
            'active' => request()->routeIs('admin.requirements.index') or request()->routeIs('admin.requirements.create') or request()->routeIs('admin.requirements.edit'),
            'icon' => 'attach-outline',
            'can' => 'admin.requirements.index'
          ],
          [
            'id' => 'tipos-de-tramite',
            'title' => 'Tipos de tramite',
            'url' => route('admin.typeprocedures.index'),
            'active' => request()->routeIs('admin.typeprocedures.index') or request()->routeIs('admin.typeprocedures.create') or request()->routeIs('admin.typeprocedures.edit'),
            'icon' => 'briefcase-outline',
            'can' => 'admin.typeprocedures.index'
          ]
        ];
      @endphp
      @include('layouts.partials.admin.sidebar')
      <div class="flex flex-col flex-1 h-full overflow-hidden">
        @include('layouts.partials.admin.navigation')
        <main class="flex-1 max-h-full overflow-hidden overflow-y-scroll bg-[#f1f3f6] scrollbar">
          {{ $slot }}
        </main>
        @include('layouts.partials.admin.footer')
      </div>
    </div>
    @livewireChartsScripts
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    @stack('js')
    @livewireScripts
  </body>
</html>
