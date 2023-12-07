<?php

namespace App\Http\Livewire\Admin\Requirements;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateTimeFilter;
use App\Exports\RequirementsExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Requirement;

class RequirementTable extends DataTableComponent
{
    protected $model = Requirement::class;

    public function filters(): array
    {
        return [
            DateTimeFilter::make('Creación desde')->filter(function(Builder $builder, string $value) { $builder->where('requirements.created_at', '>=', $value); }),
            DateTimeFilter::make('Creación a')->filter(function(Builder $builder, string $value) { $builder->where('requirements.created_at', '<=', $value); }),
            SelectFilter::make('Estado')
                ->setFilterPillTitle('Estado')
                ->setFilterPillValues(['activo' => 'Activo', 'inactivo' => 'Inactivo',])
                ->options(['' => 'Todo', 'activo' => 'Activo', 'inactivo' => 'Inactivo',])
                ->filter(function(Builder $builder, string $value) {
                  if ($value === 'activo') {
                      $builder->where('requirements.state', 'Activo');
                  } elseif ($value === 'inactivo') {
                      $builder->where('requirements.state', 'Inactivo');
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
        Requirement::whereIn('id', $this->getSelected())->update(['state' => 'Activo']);
        $this->notice('Se activo correctamente', 'success');
        $this->clearSelected();
    }

    public function inactivate(): void
    {
        Requirement::whereIn('id', $this->getSelected())->update(['state' => 'Inactivo']);
        $this->notice('Se desactivo correctamente', 'alert');
        $this->clearSelected();
    }

    public function export()
    {
        $requirements = $this->getSelected();
        $this->clearSelected();
        $this->notice('Se exporto correctamente', 'info');
        return Excel::download(new RequirementsExport($requirements), 'requisitos.xlsx');
    }

    public function columns(): array
    {
        return [
            Column::make("Nombre", "name")
                ->searchable(),
            Column::make("Descripción", "description")
                ->searchable(),
            Column::make("Estado", "state")
                ->searchable(),
            Column::make("Creado", "created_at")
                ->format(fn($value, $row, Column $column) => ''.$row->created_at->format('d/m/Y H:i a').'')->html(),
            Column::make("Acción", "id")
                ->format(fn($value, $row, Column $column) => view('admin.requirements.actions')->withRow($row)->withValue($value)),
        ];
    }

    public function builder(): Builder
    {
        return Requirement::query()->orderBy('created_at', 'desc');
    }
}
