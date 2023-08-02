<?php

namespace App\Http\Livewire\Admin\Requirements;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateTimeFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateFilter;
use App\Exports\RequirementsExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
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
            $builder->where('requirements.state', 'activo');
        } elseif ($value === 'inactivo') {
            $builder->where('requirements.state', 'inactivo');
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
    Requirement::whereIn('id', $this->getSelected())->update(['state' => 'activo']);
    $this->notice('Se activo correctamente', 'success');
    $this->clearSelected();
  }

  public function deactivate()
  {
    Requirement::whereIn('id', $this->getSelected())->update(['state' => 'inactivo']);
    $this->notice('Se desactivo correctamente', 'alert');
    $this->clearSelected();
  }

  public function deleteRequirement($value)
  {
    $requirement_in_typeprocedure = DB::table('requirement_typeprocedure')->join('requirements', 'requirement_typeprocedure.requirement_id', '=', 'requirements.id')->join('typeprocedures', 'requirement_typeprocedure.typeprocedure_id', '=', 'typeprocedures.id')->where([['requirement_typeprocedure.requirement_id', '=', $value]])->select('requirements.*')->get();
    if($requirement_in_typeprocedure->count() > 0){
      $this->notice('El requisito se encuentra en uso actualmente', 'info');
    } else {
      Requirement::where('id', $value)->delete();
      $this->notice('Se eliminó el requisito correctamente', 'alert');
    }
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
        ->sortable()
        ->searchable(),
      Column::make("Descripción", "description")
        ->sortable()
        ->searchable(),
      Column::make("Estado", "state")
        ->sortable()
        ->searchable(),
        Column::make("Fecha de creación", "created_at")
        ->sortable()
        ->format(fn($value, $row, Column $column) => ''.$row->created_at->format('d/m/Y H:i').'')->html(),
        Column::make("Acciones", "id")
        ->format(fn($value, $row, Column $column) => view('admin.requirements.actions')->withRow($row)->withValue($value)),
    ];
  }

  public function builder(): Builder
  {
    return Requirement::query()->orderBy('created_at', 'desc');
  }
}
