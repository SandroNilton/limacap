<?php

namespace App\Http\Livewire\Admin\Customers;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateTimeFilter;
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
                        $builder->where('users.state', '1');
                    } elseif ($value === 'inactivo') {
                        $builder->where('users.state', '0');
                    }
                }),
            SelectFilter::make('Tipo')
                ->setFilterPillTitle('Tipo')
                ->setFilterPillValues(['natural' => 'Natural', 'juridico' => 'Jurídico', 'agremiado' => 'Agremiado'])
                ->options(['' => 'Todo', 'natural' => 'Natural', 'juridico' => 'Jurídico', 'agremiado' => 'Agremiado'])
                ->filter(function(Builder $builder, string $value) {
                    if ($value === 'natural') {
                        $builder->where('type', '0');
                    } elseif ($value === 'juridico') {
                        $builder->where('type', '1');
                    } elseif ($value === 'agremiado') {
                        $builder->where('type', '2');
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
        User::whereIn('id', $this->getSelected())->update(['state' => '1']);
        $this->notice('Se activo correctamente', 'success');
        $this->clearSelected();
    }

    public function inactivate(): void
    {
        User::whereIn('id', $this->getSelected())->update(['state' => '0']);
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
            Column::make("Clase", "type")
                ->sortable()
                ->format(
                  fn($value, $row, Column $column) => $row->class
                ),
            Column::make("Tipo doc.", "code_type")
                ->sortable(),
            Column::make("Documento", "code")
                ->sortable()
                ->searchable(),
            Column::make("Nombre", "name")
                ->sortable()
                ->searchable(),
            Column::make("Correo", "email")
                ->sortable()
                ->searchable(),
            Column::make("Estado", "state")
                ->format(
                  fn($value, $row, Column $column) => $row->status
                ), 
            Column::make("Creado", "created_at")
                ->sortable()
                ->format(fn($value, $row, Column $column) => ''.$row->created_at->format('d/m/Y H:i').'')->html(),
            Column::make("Acción", "id")
                ->format(fn($value, $row, Column $column) => view('admin.customers.actions')->withRow($row)->withValue($value)),
        ];
    }

    public function builder(): Builder
    {
        return User::query()->where('type', '!=', 4)->where('is_admin', '!=', 1);
        //User::query()->where('type', '!=', 10)->where('is_admin', '!=', 1)->orderBy('created_at', 'desc');
    }
}
