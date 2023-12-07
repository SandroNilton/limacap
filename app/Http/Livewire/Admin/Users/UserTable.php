<?php

namespace App\Http\Livewire\Admin\Users;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateTimeFilter;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\User;

class UserTable extends DataTableComponent
{
    protected $model = User::class;

    public function filters(): array
    {
        return [
            DateTimeFilter::make('Creación desde')->filter(function(Builder $builder, string $value) { $builder->where('users.created_at', '>=', $value); }),
            DateTimeFilter::make('Creación a')->filter(function(Builder $builder, string $value) { $builder->where('users.created_at', '<=', $value); }),
            SelectFilter::make('Estado')
            ->setFilterPillTitle('Estado')
            ->setFilterPillValues(['activo' => 'Activo', 'inactivo' => 'Inactivo',])
            ->options(['' => 'Todo', 'activo' => 'Activo', 'inactivo' => 'Inactivo',])
            ->filter(function(Builder $builder, string $value) {
              if ($value === 'activo') {
                  $builder->where('users.state', 'Activo');
              } elseif ($value === 'inactivo') {
                  $builder->where('users.state', 'Inactivo');
              }
            }),
        ];
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setHideBulkActionsWhenEmptyStatus(true);
        $this->setBulkActionsEnabled();
    }

    public function bulkActions(): array
    {
        return [
            'activate' => 'Activar',
            'inactivate' => 'Inactivar',
            'export' => 'Exportar',
        ];
    }

    public function activate(): void
    {
        User::whereIn('id', $this->getSelected())->update(['state' => 'Activo']);
        $this->notice('Se activo correctamente', 'success');
        $this->clearSelected();
    }

    public function inactivate(): void
    {
        User::whereIn('id', $this->getSelected())->update(['state' => 'Inactivo']);
        $this->notice('Se inactivo correctamente', 'alert');
        $this->clearSelected();
    }

    public function export()
    {
        $users = $this->getSelected();
        $this->clearSelected();
        $this->notice('Se exporto correctamente', 'info');
        return Excel::download(new UsersExport($users), 'usuarios.xlsx');
    }

    public function columns(): array
    {
        return [
            Column::make("Nombre", "name")
                ->sortable()
                ->searchable(),
            Column::make("Correo", "email")
                ->sortable()
                ->searchable(),
            Column::make("Area", "area.name")
                ->sortable()
                ->searchable(),
            Column::make("Estado", "state")
                ->sortable()
                ->searchable(),
            Column::make("Creado", "created_at")
                ->sortable()
                ->format(fn($value, $row, Column $column) => ''.$row->created_at->format('d/m/Y H:i').'')->html(),
            Column::make('Acción', "id")
                ->format(  fn($value, $row, Column $column) => view('admin.users.actions')->withRow($row)->withValue($value) ),
        ];
    }

    public function builder(): Builder
    {
        return User::query()->where('users.email', '!=', 'admin@gmail.com')->where('is_admin', '=', 1);
        //return User::query()->where('users.email', '!=', 'admin@gmail.com')->where('is_admin', '=', 1)->orderBy('created_at', 'desc');
    }
}
