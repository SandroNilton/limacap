<?php

namespace App\Http\Livewire\Admin\Areas;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateTimeFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateFilter;
use App\Exports\AreasExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Typeprocedure;
use App\Models\Procedure;
use App\Models\User;
use App\Models\Area;

class AreaTable extends DataTableComponent
{
  protected $model = Area::class;

  public function filters(): array
  {
    return [
      DateTimeFilter::make('Creación desde')->filter(function(Builder $builder, string $value) { $builder->where('areas.created_at', '>=', $value); }),
      DateTimeFilter::make('Creación a')->filter(function(Builder $builder, string $value) { $builder->where('areas.created_at', '<=', $value); }),
      SelectFilter::make('Estado')
      ->setFilterPillTitle('Estado')
      ->setFilterPillValues(['activo' => 'Activo', 'inactivo' => 'Inactivo',])
      ->options(['' => 'Todo', 'activo' => 'Activo', 'inactivo' => 'Inactivo',])
      ->filter(function(Builder $builder, string $value) {
        if ($value === 'activo') {
            $builder->where('areas.state', 'activo');
        } elseif ($value === 'inactivo') {
            $builder->where('areas.state', 'inactivo');
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
    Area::whereIn('id', $this->getSelected())->update(['state' => 'activo']);
    $this->notice('Se activo correctamente', 'success');
    $this->clearSelected();
  }

  public function deactivate()
  {
    Area::whereIn('id', $this->getSelected())->update(['state' => 'inactivo']);
    $this->notice('Se desactivo correctamente', 'alert');
    $this->clearSelected();
  }

  public function deleteArea($value)
  {
    $area_in_typeprocedure = Typeprocedure::where([['area_id', '=', $value]])->get();
    $area_in_procedure = Procedure::where([['area_id', '=', $value]])->get();
    $area_in_user = User::where([['area_id', '=', $value]])->get();
    if($area_in_typeprocedure->count() > 0 || $area_in_procedure->count() > 0 || $area_in_user->count() > 0){
      $this->notice('El área se encuentra en uso actualmente', 'info');
    } else {
      Area::where('id', $value)->delete();
      $this->notice('Se eliminó el área correctamente', 'alert');
    }
  }

  public function export()
  {
    $areas = $this->getSelected();
    $this->clearSelected();
    $this->notice('Se exporto correctamente', 'info');
    return Excel::download(new AreasExport($areas), 'areas.xlsx');
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
      ->format(fn($value, $row, Column $column) => view('admin.areas.actions')->withRow($row)->withValue($value)),
    ];
  }

  public function builder(): Builder
  {
    return Area::query()->orderBy('created_at', 'desc');
  }
}
