@if ($row->admin_id == "" || $row->admin_id == NULL)
  @if (Auth::user()->can('admin.procedures.assign_me'))
    @can('admin.procedures.assign_me')
      <a class="items-center inline-flex cursor-pointer" wire:click="assignme('{{ $row->id }}')">
        <ion-icon name="hand-right" class="text-[15px] text-[#42a692]" wire:ignore></ion-icon>
      </a>
    @endcan
  @else
    <div class="">sin asignar</div>
  @endif
@else
    <div class="">{{ $row->admin->name }}</div>
@endif
