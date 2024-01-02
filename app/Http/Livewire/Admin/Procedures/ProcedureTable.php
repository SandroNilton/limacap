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
                if ($value === '0') { $builder->where('procedures.state', "Sin asignar"); }
                elseif ($value === '1') { $builder->where('procedures.state', "Asignado"); }
                elseif ($value === '2') { $builder->where('procedures.state', "Observado"); }
                elseif ($value === '3') { $builder->where('procedures.state', "revisado"); }
                elseif ($value === '4') { $builder->where('procedures.state', "Aprobado"); }
                elseif ($value === '5') { $builder->where('procedures.state', "Rechazado"); }
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
            Procedure::where('id', $procedure->id)->update(['admin_id' => auth()->user()->id, 'state' => "Asignado"]);
            Procedurehistory::create([
                'procedure_id' => $procedure->id,
                'area_id' => $procedure->area_id,
                'admin_id' => auth()->user()->id,
                'action' => "El usuario ". auth()->user()->name ." se auto asigno el trámite." ,
                'state' => "Asignado"
            ]);
            $this->notice('Tomaste este trámite', 'success');
        } else {
            $this->notice('El trámite ya fue tomado', 'alert');
        }
    }

    public function columns(): array
    {
        return [
          Column::make("Expediente", "type")
                ->sortable(),
            Column::make("Expediente", "id")
                ->sortable(),
            Column::make("Cliente", "user.name")
                ->searchable(),
            Column::make("Tipo de trámite", "typeprocedure.name")
                ->searchable(),
            Column::make("Área", "area.name")
                ->searchable(),
            Column::make('Usuario', 'admin_id')
                ->format( fn($value, $row, Column $column) => view('admin.procedures.assign')->withRow($row)->withValue($value) ),
            Column::make("Estado", "state")
                ->searchable(),
            Column::make("Creado", "created_at")
                ->format( fn($value, $row, Column $column) => ''.$row->created_at->format('d/m/Y H:i a').'' )->html(),
            Column::make('Accion', 'id')
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
