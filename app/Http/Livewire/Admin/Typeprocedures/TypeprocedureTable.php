<?php

namespace App\Http\Livewire\Admin\Typeprocedures;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateTimeFilter;
use App\Exports\TypeproceduresExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Typeprocedure;

class TypeprocedureTable extends DataTableComponent
{
    protected $model = Typeprocedure::class;

    public function filters(): array
    {
        return [
            DateTimeFilter::make('Creación desde')->filter(function(Builder $builder, string $value) { $builder->where('typeprocedures.created_at', '>=', $value); }),
            DateTimeFilter::make('Creación a')->filter(function(Builder $builder, string $value) { $builder->where('typeprocedures.created_at', '<=', $value); }),
            SelectFilter::make('Estado')
            ->setFilterPillTitle('Estado')
            ->setFilterPillValues(['activo' => 'Activo', 'inactivo' => 'Inactivo',])
            ->options(['' => 'Todo', 'activo' => 'Activo', 'inactivo' => 'Inactivo',])
            ->filter(function(Builder $builder, string $value) {
                if ($value === 'activo') {
                    $builder->where('typeprocedures.state', 'Activo');
                } elseif ($value === 'inactivo') {
                    $builder->where('typeprocedures.state', 'Inactivo');
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
        Typeprocedure::whereIn('id', $this->getSelected())->update(['state' => 'Activo']);
        $this->notice('Se activo correctamente', 'success');
        $this->clearSelected();
    }

    public function inactivate(): void
    {
        Typeprocedure::whereIn('id', $this->getSelected())->update(['state' => 'Inactivo']);
        $this->notice('Se desactivo correctamente', 'alert');
        $this->clearSelected();
    }

    public function export()
    {
        $typeprocedures = $this->getSelected();
        $this->clearSelected();
        $this->notice('Se exporto correctamente', 'info');
        return Excel::download(new TypeproceduresExport($typeprocedures), 'tipos de trámites.xlsx');
    }

    public function columns(): array
    {
        return [
            Column::make("Nombre", "name")
                ->searchable(),
            Column::make("Description", "description")
                ->searchable(),
            Column::make("Área", "area.name")
                ->searchable(),
            Column::make("Categoría", "category.name")
                ->searchable(),
            Column::make("Estado", "state")
                ->searchable(),
            Column::make("Creado", "created_at")
                ->format(fn($value, $row, Column $column) => ''.$row->created_at->format('d/m/Y H:i').'')->html(),
            Column::make("Acción", "id")
                ->format(fn($value, $row, Column $column) => view('admin.typeprocedures.actions')->withRow($row)->withValue($value)),
        ];
    }

    public function builder(): Builder
    {
        return Typeprocedure::query();
        //return Typeprocedure::query()->orderBy('created_at', 'desc');
    }
}
