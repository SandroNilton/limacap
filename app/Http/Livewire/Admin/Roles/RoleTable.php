<?php

namespace App\Http\Livewire\Admin\Roles;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateTimeFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateFilter;
use App\Models\Role;

class RoleTable extends DataTableComponent
{
  protected $model = Role::class;

  public function filters(): array
  {
    return [
      DateTimeFilter::make('Creación desde')->filter(function(Builder $builder, string $value) { $builder->where('roles.created_at', '>=', $value); }),
      DateTimeFilter::make('Creación a')->filter(function(Builder $builder, string $value) { $builder->where('roles.created_at', '<=', $value); }),
    ];
  }

  public function configure(): void
  {
    $this->setPrimaryKey('id');
  }

  public function deleteRole($value)
  {
    $role_in_user = DB::table('model_has_roles')->where('role_id', '=', $value)->get();
    if($role_in_user->count() > 0){
      $this->notice('El rol se encuentra en uso actualmente', 'info');
    } else {
      Role::where('id', $value)->delete();
      $this->notice('Se eliminó el rol correctamente', 'alert');
    }
  }

  public function columns(): array
  {
    return [
      Column::make("Nombre", "name")
        ->sortable()
        ->searchable(),
      Column::make("Fecha de creación", "created_at")
        ->sortable()
        ->format(fn($value, $row, Column $column) => ''.$row->created_at->format('d/m/Y H:i').'')->html(),
      Column::make("Acciones", "id")
        ->format(fn($value, $row, Column $column) => view('admin.roles.actions')->withRow($row)->withValue($value)),
    ];
  }

  public function builder(): Builder
  {
    return Role::query()->orderBy('created_at', 'desc');
  }
}
