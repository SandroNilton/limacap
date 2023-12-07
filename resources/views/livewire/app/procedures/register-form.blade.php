<div>
  <form enctype="multipart/form-data" action="{{ route('app.procedures.store') }}" method="POST">
    @csrf
    <div class="mb-3">
      <x-input-label>Categoría</x-input-label>
      <x-select wire:model="selectedCategory" name="category_id" id="category_id" required="true">
        <option value="">seleccione la categoría</option>
        @forelse ($categories as $category)
          <option value="{{ $category->id }}">{{ $category->name }}</option>
          @empty
        @endforelse
      </x-select>
    </div>
    @if ($selectedCategory)
      <div class="mb-3">
        <x-input-label>Tipo de trámite</x-input-label>
        <x-select wire:model="selectedTypeprocedure" name="typeprocedure_id" id="typeprocedure_id" required="true">
          <option value="">Seleccione tipo de trámite</option>
          @forelse ($typeprocedures as $typeprocedure)
            <option value="{{ $typeprocedure->id }}">{{ $typeprocedure->name }}</option>
            @empty
          @endforelse
        </x-select>
      </div>
    @endif
    @if ($selectedTypeprocedure)
      <div class="mb-3">
        <x-input-label>Requisitos de trámite</x-input-label>
        <div class="bg-[#F3F4F6] p-4 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3 rounded-md">
          @forelse ($requirements as $requirement)
            <div class="col-span-3 md:col-span-1 border border-dashed border-[#d9d9da] transition duration-300 flex flex-row rounded-md hover:border-[#0d8a72]">
              <input type="hidden" name="files[][id]" value="{{ $requirement->id }}">
              <div class="px-4 inline-flex items-center border-r border-[#d9d9da] bg-white rounded-md">
                <span class="text-[13px] text-[#414d6a]">{{ $requirement->name }}</span>
              </div>
              <input name="files[][file]" id="files" class="cursor-pointer rounded-md w-full flex text-[13px] leading-4 text-center justify-center bg-white py-1.5 px-3.5 relative m-0 flex-auto duration-300 ease-in-out file:hidden focus:outline-none" type="file" accept="" ref="fileInput" @required(true)>
            </div>
            @empty
            <div class="w-full border border-dashed border-[#d9d9da] transition duration-300 flex flex-row rounded-md">
              <div class="rounded-[3px] w-full flex py-1.5 justify-center">
                <span class="text-[13px]">No hay requisitos</span>
              </div>
            </div>
          @endforelse
        </div>
      </div>
    @endif
    <div class="mb-3">
      <x-input-label>Descripción</x-input-label>
      <x-text-area name="description" placeholder="Descripción" rows="4"></x-text-area>
    </div>
    <x-primary-button class="gap-2">
      <ion-icon name="add-circle-outline" class="text-lg" wire:ignore></ion-icon>Guardar
    </x-primary-button>
  </form>
</div>
