<div class="flex space-x-2">
  @can('admin.users.edit')
    <a class="bg-[#fdb10b] px-2 rounded-[3px] text-white text-xs py-0.5" href="{{ route('admin.procedures.edit', ['procedure' => $value ]) }}">
      Editar
    </a>
  @endcan
</div>
