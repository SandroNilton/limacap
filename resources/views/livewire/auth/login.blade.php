<div>
  <section class="flex flex-col md:flex-row h-screen items-center">
    <div class="hidden md:block w-full md:w-1/2 xl:w-2/3 h-screen">
      @include('layouts.partials.guest.slide')
    </div>
    <div class="bg-white w-full md:max-w-md lg:max-w-full md:mw-auto md:mx-0 md:w-1/2 xl:w-1/3 h-screen px-6 lg:px-16 xl:px-12 flex items-center justify-center overflow-hidden overflow-y-scroll">
      <div class="w-full h-100 px-4">
        <div class="justify-center flex -mt-50 mb-20">
            <a href="{{ route('consult') }}">
                <img src="https://www.satjlo.gob.pe/dashboard/wp-content/uploads/2022/11/descarga.png" width="200" alt="">
            </a>
        </div>
        <div class="justify-center flex">
          <img src="https://i.postimg.cc/PqDTPv8d/logo-niubiz-removebg-preview-3.png" width="220" alt="">
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        @error('session')
          <span class="text-[13px] scale-75 text-[#d72d30] mb-0 mt-0.5">{{ $message }}</span>
        @enderror
        <form action="{{ route('login') }}" class="mt-6" method="POST">
          @csrf
          <div class="relative z-0 pt-1">
            <input type="email" id="email" name="email" :value="old('email')" wire:model="email" class="rounded-[3px] peer bg-transparent block w-full py-1.5 leading-4 text-[13px] border-[#cdd5de] focus:border-inherit focus:ring-0 @if($errors->has('email')) border-[#d72d30] @endif" placeholder="Correo electrónico" autofocus autocomplete="username"/>
            @error('email')
              <span class="text-xs scale-75 text-[#d72d30] mb-0 mt-0.5">{{ $message }}</strong>
            @enderror
          </div>
          <div class="mt-4 relative z-0">
            <input type="password" id="password" name="password" wire:model="password" class="rounded-[3px] peer bg-transparent block w-full py-1.5 leading-4 text-[13px] border-[#cdd5de] focus:border-inherit focus:ring-0 @if($errors->has('password')) border-[#d72d30] @endif" placeholder="Contraseña" autocomplete="current-password">
            @error('password')
              <span class="text-xs scale-75 text-[#d72d30] mb-0 mt-0.5">{{ $message }}</strong>
            @enderror
          </div>
          <div class="mt-3.5 flex justify-between">
            <div class="self-center">
               <label class="inline-flex items-center">
                <input type="checkbox" id="remember_me" name="remember" class="form-checkbox text-[13px] leading-4 rounded-[3px] h-3.5 w-3.5 border-[#cfd7df] hover:border-[#42a692] transition duration-300 text-[#42a692] cursor-pointer"/>
                <span class="ml-2 cursor-pointer text-[13px] leading-4 text-[#414d6a]">Recuerdame</span>
              </label>
            </div>
            @if (Route::has('password.request'))
              <div class="">
                <a href="{{ route('password.request') }}" class="text-[13px] leading-4 text-[#42a692] hover:text-[#2c6f62] transition duration-300">¿Olvidaste tu contraseña?</a>
              </div>
            @endif
          </div>
          <div class="mt-3.5">
            <button type="submit" class="bg-[#42a692] rounded-[3px] peer text-white block w-full py-1.5 leading-4 text-[13px] focus:ring-0">Ingresar</button>
          </div>
        </form>
        <div class="mt-4 flex">
          <span class="text-[13px] text-[#414d6a] leading-4 mr-3">¿No tienes una cuenta?</span>
          <a href="{{ route('register') }}">
            <x-primary-button type="button">Registrarte aquí</x-primary-button>
          </a>
        </div>
      </div>
    </div>
  </section>
</div>
