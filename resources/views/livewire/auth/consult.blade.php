<div class="w-full h-full p-4">
    <div class="flex flex-col h-full gap-4 w-full items-center">
        <p class="mb-1 text-md font-semibold text-[rgb(17,24,39)] text-opacity-100">Consulta el estado de tu trámite</p>
    <div class="w-1/2">
        <form wire:submit.prevent="consult">
            <div class="mb-3">
                <x-text-input wire:model="code" type="text" name="code" placeholder="Codigo"/>
                <x-input-error :messages="$errors->get('code')" class="mt-2" />
            </div>
            <x-primary-button class="gap-2">
                <ion-icon name="add-circle-outline" class="text-lg" wire:ignore></ion-icon>Consultar
            </x-primary-button>
        </form>
    </div>
    <div class="grid grid-cols-1 gap-4">
        <div>
            @if ($data != null)
                <div class="bg-white bg-opacity-100 border-b border-opacity-100 rounded-md border-[rgb(229,231,235)] shadow p-4">
                    {{ $data }}
                </div>
            @else
                <div>no data buscadA</div>
            @endif

        </div>
    </div>
    </div>
</div>
