<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('css')
  </head>
  <body class="antialiased font-inter bg-slate-100 dark:bg-slate-900 text-slate-600 dark:text-slate-400">
    <main class="bg-white">
      <div class="relative flex">
        <!-- Content -->
        <div class="w-full md:w-1/2">
          <div class="flex flex-col h-full min-h-screen after:flex-1">
            
    <livewire:laravel-notification.notice/>
    {{ $slot }}
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    @stack('js')
    @livewireScripts
  </body>
</html>
