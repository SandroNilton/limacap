@push('css')
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <style>
    .select2 {
      width: 100%!important;
      font-family: unset;
    }

    .select2-container--default.select2-container--focus .select2-selection--multiple {
      border: solid #cdd5de 1px;
      outline: 0;
    }

    .select2-container .select2-search--inline .select2-search__field {
      line-height: inherit;
      font-family: inherit;
      padding-left: 0.40rem;
    }

    .select2-container--default .select2-selection--multiple {
      background-color: white;
      border: 1px solid #cdd5de;
      border-radius: 3px;
      cursor: text;
      padding-bottom: 0px;
      padding-right: 0px;
      position: relative;
      font-size: 0.77rem/* 12px */;
      line-height: 1.3rem/* 16px */;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__choice {
      background-color: #ffff;
      border: 1px solid #cdd5de;
      border-radius: 3px;
      box-sizing: border-box;
      display: inline-block;
      margin-left: 4px;
      margin-top: 4px;
      padding: 0;
      padding-left: 20px;
      position: relative;
      max-width: 100%;
      overflow: hidden;
      text-overflow: ellipsis;
      vertical-align: bottom;
      white-space: nowrap;
    }

    .select2-container--default .select2-results__option--highlighted.select2-results__option--selectable {
      background-color: #0d8a72;
      color: white;
    }
  </style>
@endpush
<div>
  <div class="flex justify-between items-center py-2 px-3 border-b border-[#cdd5de] bg-white">
    <span class="text-[#414d6a] text-[13px]">Editar tipo de trámite</span>
    @can('admin.typeprocedures.destroy')
      <button wire:click="deleteTypeprocedure({{ $typeprocedure }})" class="text-[#C83232] px-2 rounded-[3px] text-[13px] items-center inline-flex gap-1">
        <ion-icon name="trash-outline" wire:ignore></ion-icon> Eliminar
      </button>
    @endcan
  </div>
  <form wire:submit.prevent="updateTypeprocedure" class="p-[12px] bg-[#f1f3f6] sm:flex gap-3">
    <div class="w-full mb-3">
      <div class="border border-[#cdd5de] bg-white mb-4 rounded-[3px]">
        <div class="w-full flex justify-between items-center py-2 px-2.5 border-b border-[#cdd5de]">
          <span class="text-[13px] text-[#414d6a] leading-4">Parametros de usuario</span>
        </div>
        <div class="w-full p-[12px]">
          <div class="mb-3">
            <input wire:model="name" type="text" name="name" placeholder="Nombre" class="w-full py-1.5 text-[13px] text-[#414d6a] leading-4 rounded-[3px] border-[#cdd5de] focus:border-inherit focus:ring-0 @if($errors->has('name')) border-[#d72d30] @endif"/>
            @error('name')
              <span class="px-3 text-xs scale-75 text-[#d72d30] mb-0 mt-0.5">{{ $message }}</strong>
            @enderror
          </div>
          <div class="mb-4">
            <select wire:model="area_id" name="area_id" class="w-full py-1.5 text-[13px] text-[#414d6a] leading-4 rounded-[3px] border-[#cdd5de] focus:border-inherit focus:ring-0 @if($errors->has('area_id')) border-[#d72d30] @endif">
              <option value=""> Seleccione el área </option>
              @foreach ($areas as $area)
                <option value="{{ $area->id }}">{{ $area->name }}</option>
              @endforeach
            </select>
            @error('area_id')
              <span class="px-3 text-xs scale-75 text-[#d72d30] mb-0 mt-0.5">{{ $message }}</strong>
            @enderror
          </div>
          <div class="mb-4">
            <select wire:model="category_id" name="category_id" class="w-full py-1.5 text-[13px] text-[#414d6a] leading-4 rounded-[3px] border-[#cdd5de] focus:border-inherit focus:ring-0 @if($errors->has('category_id')) border-[#d72d30] @endif">
              <option value=""> Seleccione la categoría </option>
              @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
              @endforeach
            </select>
            @error('category_id')
              <span class="px-3 text-xs scale-75 text-[#d72d30] mb-0 mt-0.5">{{ $message }}</strong>
            @enderror
          </div>
          <div class="mb-4" wire:ignore>
            <select wire:model.lazy="requirements_val" name="requirements" class="requirement-multiple w-full py-1.5 text-[13px] text-[#414d6a] leading-4 rounded-[3px] focus:ring-0 @if($errors->has('requirements')) border-[#d72d30] @endif" multiple="multiple">
              @foreach ($typeprocedure->requirements as $requirement)
                <option value="{{ $requirement->id }}" selected> {{ $requirement->name }}</option>
              @endforeach
            </select>
            @error('requirements')
              <span class="px-3 text-xs scale-75 text-[#d72d30] mb-0 mt-0.5">{{ $message }}</strong>
            @enderror
          </div>
          <div class="mb-4">
            <div class="flex flex-wrap items-stretch w-full relative">
              <div class="flex -mr-px">
                <span class="flex items-center bg-[#0d8a72] border-[#0d8a72] text-white rounded-[3px] rounded-r-none px-2 text-[13px] leading-4">S/.</span>
              </div>
              <input wire:model="price" type="number" name="price" placeholder="Precio" class="rounded-l-none relative flex-1 w-full py-1.5 text-[13px] text-[#414d6a] leading-4 rounded-[3px] border-[#cdd5de] focus:border-inherit focus:ring-0 @if($errors->has('price')) border-[#d72d30] @endif"/>
            </div>
            @error('price')
              <span class="px-3 text-xs scale-75 text-[#d72d30] mb-0 mt-0.5">{{ $message }}</strong>
            @enderror
          </div>
          <div class="mb-2">
            <textarea wire:model="description" type="text" name="description" placeholder="Descripción" class="w-full py-1.5 text-[13px] text-[#414d6a] leading-4 rounded-[3px] border-[#cdd5de] focus:border-inherit focus:ring-0"></textarea>
          </div>
          <div class="mb-2">
            <select wire:model="state" name="state" class="w-full py-1.5 text-[13px] text-[#414d6a] leading-4 rounded-[3px] border-[#cdd5de] focus:border-inherit focus:ring-0">
              <option value="activo">Activo</option>
              <option value="inactivo">Inactivo</option>
            </select>
          </div>
          @can('admin.requirements.edit')
            <div>
              <button type="submit" class="text-[#0d8a72] text-[13px] leading-4 items-center inline-flex gap-1 align-middle"><ion-icon name="pencil-outline" wire:ignore></ion-icon> Editar</button>
            </div>
          @endcan
        </div>
      </div>
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



