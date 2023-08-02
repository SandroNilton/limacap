<?php

namespace App\Http\Livewire\Admin\Customers;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateTimeFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateFilter;
use App\Exports\CustomersExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\User;

class CustomerTable extends DataTableComponent
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
                $builder->where('users.state', 'activo');
            } elseif ($value === 'inactivo') {
                $builder->where('users.state', 'inactivo');
            }
        }),
        SelectFilter::make('Tipo')
        ->setFilterPillTitle('Tipo')
        ->setFilterPillValues(['1' => 'Natural', '2' => 'Jurídico', '3' => 'Agremiado'])
        ->options(['' => 'Todo', '1' => 'Natural', '2' => 'Jurídico', '3' => 'Agremiado'])
        ->filter(function(Builder $builder, string $value) {
          if ($value === '1') {
              $builder->where('type', 1);
          } elseif ($value === '2') {
              $builder->where('type', 2);
          } elseif ($value === '3') {
              $builder->where('type', 3);
        }
        }),
      ];
    }

    public function configure(): void
    {
      $this->setPrimaryKey('id');
      $this->setHideBulkActionsWhenEmptyStatus(true);
      $this->setBulkActions([
        'exportSelected' => 'Exportar',
      ]);
      $this->setBulkActionsEnabled();
    }

    public function bulkActions(): array
    {
      return [
        'activate' => 'Activar',
        'deactivate' => 'Desactivar',
        'export' => 'Exportar',
      ];
    }

    public function activate()
  {
      User::whereIn('id', $this->getSelected())->update(['state' => 'activo']);
      $this->notice('Se activo correctamente', 'success');
      $this->clearSelected();
  }

  public function deactivate()
  {
    User::whereIn('id', $this->getSelected())->update(['state' => 'inactivo']);
    $this->notice('Se desactivo correctamente', 'alert');
    $this->clearSelected();
  }

  public function export()
  {
    $customers = $this->getSelected();
    $this->clearSelected();
    $this->notice('Se exporto correctamente', 'info');
    return Excel::download(new CustomersExport($customers), 'clientes.xlsx');
  }

    public function columns(): array
    {
      return [
        Column::make("Tipo", "type")
          ->sortable()
          ->format( fn($value, $row, Column $column) => view('admin.customers.type')->withRow($row)->withValue($value) ),
        Column::make("Codigo", "code")
          ->sortable()
          ->searchable(),
        Column::make("Nombre", "name")
          ->sortable()
          ->searchable(),
        Column::make("Correo", "email")
          ->sortable()
          ->searchable(),
        Column::make("Estado", "state")
          ->sortable()
          ->searchable(),
          Column::make("Fecha de creación", "created_at")
          ->sortable()
          ->format(fn($value, $row, Column $column) => ''.$row->created_at->format('d/m/Y H:i').'')->html(),
          Column::make("Acciones", "id")
          ->format(fn($value, $row, Column $column) => view('admin.customers.actions')->withRow($row)->withValue($value)),
      ];
    }

    public function builder(): Builder
    {
      return User::query()->where('type', '!=', 10)->where('is_admin', '!=', 1)->orderBy('created_at', 'desc');
    }
}
