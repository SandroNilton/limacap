<div>
  <section class="flex flex-col md:flex-row h-screen items-center">
    <div class="hidden md:block w-full md:w-1/2 xl:w-2/3 h-screen">
      @include('layouts.partials.guest.slide')
    </div>
    <div class="bg-white w-full md:max-w-md lg:max-w-full md:mw-auto md:mx-0 md:w-1/2 xl:w-1/3 h-screen px-6 lg:px-16 xl:px-12 flex items-center justify-center overflow-hidden overflow-y-scroll">
      <div class="w-full h-100 px-4">
        <div class="justify-center flex">
          <img src="https://i.postimg.cc/PqDTPv8d/logo-niubiz-removebg-preview-3.png" width="240" alt="">
        </div>
        @if (session('status'))
          <div class="mb-4 font-medium text-sm text-green-600">
            {{ session('status') }}
          </div>
        @endif
        @error('session')
          <span class="text-sm scale-75 text-[#d72d30] mb-0 mt-0.5">{{ $message }}</span>
        @enderror
        <form action="{{ route('login') }}" class="mt-6" method="POST">
          @csrf
          <div class="relative z-0 pt-6">
            <input type="email" id="email" name="email" :value="old('email')" wire:model="email" class="rounded peer bg-transparent block w-full py-1.5 text-sm border-[#cfd7df] hover:border-[#42a692] transition duration-300 focus:border-[#42a692] focus:outline-none focus:ring-0 @if($errors->has('email')) border-[#d72d30] @endif" placeholder="Correo electrónico" autofocus autocomplete="username"/>
            @error('email')
              <span class="text-xs scale-75 text-[#d72d30] mb-0 mt-0.5">{{ $message }}</strong>
            @enderror
          </div>
          <div class="mt-4 relative z-0">
            <input type="password" id="password" name="password" wire:model="password" class="rounded peer bg-transparent block w-full py-1.5 text-sm border-[#cfd7df] hover:border-[#42a692] transition duration-300 focus:border-[#42a692] focus:outline-none focus:ring-0 @if($errors->has('password')) border-[#d72d30] @endif" placeholder="Contraseña" autocomplete="current-password">
            @error('password')
              <span class="text-xs scale-75 text-[#d72d30] mb-0 mt-0.5">{{ $message }}</strong>
            @enderror
          </div>
          <div class="mt-4 flex justify-between">
            <div class="self-center">
               <label class="inline-flex items-center">
                <input type="checkbox" id="remember_me" name="remember" class="form-checkbox text-sm rounded-sm h-3.5 w-3.5 border-[#cfd7df] hover:border-[#42a692] transition duration-300 text-[#42a692] cursor-pointer"/>
                <span class="ml-2 cursor-pointer text-sm">Recuerdame</span>
              </label>
            </div>
            @if (Route::has('password.request'))
              <div class="">
                <a href="{{ route('password.request') }}" class="text-sm font-normal text-[#42a692] hover:text-[#2c6f62] transition duration-300">¿Olvidaste tu contraseña?</a>
              </div>
            @endif
          </div>
          <div class="mt-4">
            <button type="submit" class="w-full font-extrabold bg-[#42a692] rounded text-white text-sm py-1.5 hover:bg-[#2c6f62] transition duration-300">Ingresar</button>
          </div>
        </form>
        <div class="mt-4 flex justify-between">
          <span class="text-sm">¿No tienes una cuenta?</span>
          <a href="{{ route('register') }}" class="text-sm font-normal text-[#42a692] hover:text-[#2c6f62] transition duration-300">Registrarte aquí</a>
        </div>
      </div>
    </div>
  </section>
</div>

 <!-- Session Status -->
  <x-auth-session-status class="mb-4" :status="session('status')" />

  <form method="POST" action="{{ route('login') }}">
      @csrf

      <!-- Email Address -->
      <div>
          <x-input-label for="email" :value="__('Email')" />
          <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
          <x-input-error :messages="$errors->get('email')" class="mt-2" />
      </div>

      <!-- Password -->
      <div class="mt-4">
          <x-input-label for="password" :value="__('Password')" />

          <x-text-input id="password" class="block mt-1 w-full"
                          type="password"
                          name="password"
                          required autocomplete="current-password" />

          <x-input-error :messages="$errors->get('password')" class="mt-2" />
      </div>

      <!-- Remember Me -->
      <div class="block mt-4">
          <label for="remember_me" class="inline-flex items-center">
              <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
              <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
          </label>
      </div>

      <div class="flex items-center justify-end mt-4">
          @if (Route::has('password.request'))
              <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                  {{ __('Forgot your password?') }}
              </a>
          @endif

          <x-primary-button class="ml-3">
              {{ __('Log in') }}
          </x-primary-button>
      </div>
  </form>
