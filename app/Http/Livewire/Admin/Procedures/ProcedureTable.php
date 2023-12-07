<?php

namespace App\Http\Livewire\Admin\Procedures;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateTimeFilter;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Procedure;
use App\Models\Procedurehistory;
use App\Models\User;

class ProcedureTable extends DataTableComponent
{
  protected $model = Procedure::class;

  public function filters(): array
  {
    return [
      DateTimeFilter::make('Creación desde')->filter(function(Builder $builder, string $value) { $builder->where('procedures.created_at', '>=', $value); }),
      DateTimeFilter::make('Creación a')->filter(function(Builder $builder, string $value) { $builder->where('procedures.created_at', '<=', $value); }),
      SelectFilter::make('Estado')
      ->setFilterPillTitle('Estado')
      ->setFilterPillValues(['0' => 'Sin asignar', '1' => 'Asignado', '2' => 'Observado', '3' => 'Revisado', '4' => 'Aprobado', '5' => 'Rechazado'])
      ->options(['' => 'Todo', '0' => 'Sin asignar', '1' => 'Asignado', '2' => 'Observado', '3' => 'Revisado', '4' => 'Aprobado', '5' => 'Rechazado'])
      ->filter(function(Builder $builder, string $value) {
        if ($value === '1') { $builder->where('procedures.state', 0); }
        elseif ($value === '2') { $builder->where('procedures.state', 1); }
        elseif ($value === '3') { $builder->where('procedures.state', 2); }
        elseif ($value === '4') { $builder->where('procedures.state', 3); }
        elseif ($value === '5') { $builder->where('procedures.state', 4); }
        elseif ($value === '6') { $builder->where('procedures.state', 5); }
      }),
    ];
  }

  public function configure(): void
  {
    $this->setPrimaryKey('id');
  }

  public function assignme($id)
  {
    $procedure = Procedure::where([['id', '=', $id], [ 'admin_id', '=', NULL]])->first();

    if($procedure->count() > 0) {
      Procedure::where('id', $procedure->id)->update(['admin_id' => auth()->user()->id]);
      Procedure::where('id', $procedure->id)->update(['state' => 1]);
      Procedurehistory::create([
        'procedure_id' => $procedure->id,
        'area_id' => $procedure->area_id,
        'admin_id' => auth()->user()->id,
        'action' => "El usuario ". auth()->user()->name ." se autoasigno el trámite." ,
        'state' => 1
      ]);
      $this->notice('Tomaste este trámite', 'success');
    } else {
      $this->notice('El trámite ya fue tomado', 'alert');
    }
  }

  public function columns(): array
  {
    return [
      Column::make("Cliente", "user.name")
        ->sortable()
        ->searchable(),
      Column::make("Tipo de trámite", "typeprocedure.name")
        ->sortable()
        ->searchable(),
      Column::make("Área", "area.name")
        ->sortable()
        ->searchable(),
      Column::make('Usuario', 'admin_id')
        ->format( fn($value, $row, Column $column) => view('admin.procedures.assign')->withRow($row)->withValue($value) ),
      Column::make("Estado", "state")
        ->format(
          fn($value, $row, Column $column) => $row->status
        ), 
      Column::make("Fecha de creación", "created_at")
        ->sortable()
        ->format( fn($value, $row, Column $column) => ''.$row->created_at->format('d/m/Y H:i').'' )->html(),
      Column::make('Acciones', 'id')
        ->format(  fn($value, $row, Column $column) => view('admin.procedures.actions')->withRow($row)->withValue($value) ),
    ];
  }

  public function builder(): Builder
  {
    if(auth()->user()->hasRole('admin')) {
      return Procedure::query()->orderBy('created_at', 'desc');
    } else {
      return Procedure::query()->where('procedures.area_id', '=', auth()->user()->area_id)->orderBy('created_at', 'desc');
    }
  }
}
