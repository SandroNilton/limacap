<div class="w-full h-full p-4">
    <div class="flex flex-col h-full gap-4 w-full items-center">
        <a href="{{ route('login') }}">
            <x-primary-button type="button">Volver al Inicio</x-primary-button>
          </a>
        <p class="mb-1 text-md font-semibold text-[rgb(17,24,39)] text-opacity-100">Consulta el estado de tu trámite</p>
    <div class="w-1/2">
        <form wire:submit.prevent="consult">
            <div class="mb-3">
              <x-text-input wire:model="code" type="text" name="code" placeholder="Codigo"/>
              <x-input-error :messages="$errors->get('code')" class="mt-2" />
            </div>
            <div class="mb-3">
              <x-text-input wire:model="codeuser" type="text" name="codeuser" placeholder="DNI / RUC"/>
              <x-input-error :messages="$errors->get('codeuser')" class="mt-2" />
            </div>
            <x-primary-button class="gap-2">
                <ion-icon name="add-circle-outline" class="text-lg" wire:ignore></ion-icon>Consultar
            </x-primary-button>
        </form>
    </div>
    <div class="grid grid-cols-1 gap-4">
        <div>
          {{ $procedure_data }}





        </div>
    </div>
    </div>
</div>
