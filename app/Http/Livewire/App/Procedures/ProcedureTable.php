<?php

namespace App\Http\Livewire\App\Procedures;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateTimeFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateFilter;
use App\Models\Procedure;

class ProcedureTable extends DataTableComponent
{
    protected $model = Procedure::class;

    public function filters(): array
    {
        return [
            DateTimeFilter::make('Creación desde')->filter(function(Builder $builder, string $value) { $builder->where('procedures.created_at', '>=', $value); }),
            DateTimeFilter::make('Creación a')->filter(function(Builder $builder, string $value) { $builder->where('procedures.created_at', '<=', $value); }),
        ];
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Tipo de trámite", "typeprocedure.name")
                ->sortable(),
            Column::make("Comentarios", "description")
                ->sortable()
                ->format(
                  fn($value, $row, Column $column) => ''. (!empty($row->description)) ? $row->description : '--' .''
                ),
            Column::make("Estado", "state")
                ->sortable()
                ->searchable(),
            Column::make("Fecha de creación", "created_at")
                ->sortable()
                ->format(
                  fn($value, $row, Column $column) => ''.$row->created_at->format('d/m/Y H:i').''
                )
                ->html(),
            Column::make('Acciones', 'id')
                ->format(
                  fn($value, $row, Column $column) => view('app.procedures.actions')->withValue($value)
                ),
        ];
    }

    public function builder(): Builder
    {
        return Procedure::query()->where('user_id', '=', auth()->id())->orderBy('created_at', 'desc');
    }
}
