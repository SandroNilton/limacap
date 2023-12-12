@push('css')
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <style>
    .select2 {
      width: 100% !important;
      font-family: unset;
    }

    .select2-container--default.select2-container--focus .select2-selection--multiple {
      border: solid #10B981 1px;
      outline: 0;
    }

    .select2-container .select2-search--inline .select2-search__field {
      line-height: inherit;
      font-family: inherit;
      padding-left: 0.40rem;
    }

    .select2-container--default .select2-selection--multiple {
      padding-top: 0.375rem;
      padding-bottom: 0.375rem;
      background-color: white;
      border: 1px solid rgb(209, 213, 219);
      border-radius: 0.375rem;
      cursor: text;
      position: relative;
      font-size: 0.875rem/* 12px */;
      line-height: 1.25rem/* 16px */;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__choice {
      background-color: #ffff;
      border: 1px solid rgb(209, 213, 219);
      border-radius: 0.375rem;
      box-sizing: border-box;
      display: inline-block;
      margin-left: 6px;
      margin-top: 0px;
      padding: 0;
      padding-left: 20px;
      position: relative;
      max-width: 100%;
      overflow: hidden;
      text-overflow: ellipsis;
      vertical-align: bottom;
      white-space: nowrap;
    }

    .select2-container .select2-search--inline .select2-search__field {
      margin-top: 0px;
      height: 20px;
    }

    .select2-container--default .select2-results__option--highlighted.select2-results__option--selectable {
      background-color: #10B981;
      color: white;
    }
  </style>
@endpush

<div>
  <form wire:submit.prevent="update">
    <div class="mb-3">
      <x-input-label>Nombre <x-wire-loading /></x-input-label>
      <x-text-input wire:model="name" type="text" name="name" placeholder="Nombre"/>
      <x-input-error :messages="$errors->get('name')" class="mt-2" />
    </div>
    <div class="mb-3">
      <x-input-label>Área</x-input-label>
      <x-select wire:model="area" name="state">
        <option value=""> Seleccione el área </option>
        @foreach ($areas as $area)
          <option value="{{ $area->id }}">{{ $area->name }}</option>
        @endforeach
      </x-select>
      <x-input-error :messages="$errors->get('area')" class="mt-2" />
    </div>
    <div class="mb-3">
      <x-input-label>Categoría</x-input-label>
      <x-select wire:model="category" name="state">
        <option value=""> Seleccione la categoría </option>
        @foreach ($categories as $category)
          <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
      </x-select>
      <x-input-error :messages="$errors->get('category')" class="mt-2" />
    </div>
    <div class="mb-3">
      <x-input-label>Precio</x-input-label>
      <x-text-input wire:model="price" type="text" x-mask:dynamic="$money($input)" name="price" placeholder="Precio" />
      <x-input-error :messages="$errors->get('price')" class="mt-2" />
    </div>
    <div class="mb-3" wire:ignore>
      <x-input-label>Requisitos</x-input-label>
      <select wire:model.lazy="requirements_val" name="requirements" class="requirement-multiple" multiple="multiple">
        @foreach ($typeprocedure->requirements as $requirement)
          <option value="{{ $requirement->id }}" selected> {{ $requirement->name }}</option>
        @endforeach
      </select>
      <x-input-error :messages="$errors->get('requirements')" class="mt-2" />
    </div>
    <div class="mb-3">
      <x-input-label>Descripción</x-input-label>
      <x-text-area wire:model="description" type="text" name="description" placeholder="Descripción" rows="4"></x-text-area>
    </div>
    <div class="mb-3">
      <x-input-label>Estado</x-input-label>
      <x-select wire:model="state" name="state">
        <option value="Inactivo">Inactivo</option>
        <option value="Activo">Activo</option>
      </x-select>
    </div>
    <div class="flex gap-3">
      @can('admin.typeprocedures.edit')
        <x-primary-button class="gap-2">
          <ion-icon name="add-circle-outline" class="text-lg" wire:ignore></ion-icon>Guardar
        </x-primary-button>
      @endcan
      @can('admin.typeprocedures.destroy')
        <x-danger-button type="button" wire:click="destroy({{ $typeprocedure }})" class="gap-2">
          <ion-icon name="trash-outline" class="text-lg" wire:ignore></ion-icon>Eliminar
        </x-danger-button>
      @endcan
    </div>
  </form>
</div>

@push('js')
  <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script>
    $(document).ready(function() {
      $('.requirement-multiple').select2({
        placeholder: '{{__('Elija sus requisitos')}}',
        ajax: {
          url: "{{ route('requirement.select2') }}",
          dataType: 'json',
          delay: 250,
          data: function(params) {
            return {
              q: params.term
            }
          },
          processResults: function(data) {
            return {
              results: data
            }
          }
        }
      });
      $('.requirement-multiple').on('change', function (e) {
          var data = $('.requirement-multiple').select2("val");
          @this.set('requirements_val', data);
      });

    });
  </script>
@endpush



