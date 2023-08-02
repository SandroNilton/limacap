<?php

namespace App\Http\Livewire\Admin\Typeprocedures;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateTimeFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateFilter;
use App\Exports\TypeproceduresExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Procedure;
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
            $builder->where('typeprocedures.state', 'activo');
        } elseif ($value === 'inactivo') {
            $builder->where('typeprocedures.state', 'inactivo');
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
    Typeprocedure::whereIn('id', $this->getSelected())->update(['state' => 'activo']);
    $this->notice('Se activo correctamente', 'success');
    $this->clearSelected();
  }

  public function deactivate()
  {
    Typeprocedure::whereIn('id', $this->getSelected())->update(['state' => 'inactivo']);
    $this->notice('Se desactivo correctamente', 'alert');
    $this->clearSelected();
  }

  public function deleteTypeprocedure($value)
  {
    $typeprocedure_in_procedure = Procedure::where([['typeprocedure_id', '=', $value]])->get();
    if($typeprocedure_in_procedure->count() > 0){
      $this->notice('El tipo de trámite se encuentra en uso actualmente', 'info');
    } else {
      Typeprocedure::where('id', $value)->delete();
      $this->notice('Se eliminó el tipo de trámite correctamente', 'alert');
    }
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
        ->sortable()
        ->searchable(),
      Column::make("Description", "description")
        ->sortable()
        ->searchable(),
      Column::make("Área", "area.name")
        ->sortable()
        ->searchable(),
      Column::make("Categoría", "category.name")
        ->sortable()
        ->searchable(),
      Column::make("Estado", "state")
        ->sortable()
        ->searchable(),
      Column::make("Fecha de creación", "created_at")
        ->sortable()
        ->format(fn($value, $row, Column $column) => ''.$row->created_at->format('d/m/Y H:i').'')->html(),
      Column::make("Acciones", "id")
      ->format(fn($value, $row, Column $column) => view('admin.typeprocedures.actions')->withRow($row)->withValue($value)),
    ];
  }

  public function builder(): Builder
  {
    return Typeprocedure::query()->orderBy('created_at', 'desc');
  }
}
