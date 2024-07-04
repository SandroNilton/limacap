<x-guest-layout>
    <section class="flex flex-col md:flex-row h-screen items-center">
        <div class="hidden md:block w-full md:w-1/2 xl:w-2/3 h-screen">
          @include('layouts.partials.guest.slide')
        </div>
        <div class="bg-white w-full md:max-w-md lg:max-w-full md:mw-auto md:mx-0 md:w-1/2 xl:w-1/3 h-screen px-6 lg:px-16 xl:px-12 flex items-center justify-center overflow-hidden overflow-y-scroll">
          <div class="w-full h-100 px-4">

            <div class="justify-center flex mb-6">
                <img src="https://i.postimg.cc/PqDTPv8d/logo-niubiz-removebg-preview-3.png" width="220" alt="">
              </div>

            <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
                {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <x-primary-button>
                        {{ __('Email Password Reset Link') }}
                    </x-primary-button>
                </div>
            </form>

          </div>
        </div>
    </section>
</x-guest-layout>
