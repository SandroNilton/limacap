<?php

namespace App\Http\Livewire\Admin\Roles;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateTimeFilter;
use App\Models\Role;

class RoleTable extends DataTableComponent
{
    protected $model = Role::class;

    public function filters(): array
    {
        return [
            DateTimeFilter::make('Creación desde')->filter(function(Builder $builder, string $value) { $builder->where('roles.created_at', '>=', $value); }),
            DateTimeFilter::make('Creación a')->filter(function(Builder $builder, string $value) { $builder->where('roles.created_at', '<=', $value); }),
        ];
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Nombre", "name")
                ->searchable(),
            Column::make("Creado", "created_at")
                ->format(fn($value, $row, Column $column) => ''.$row->created_at->format('d/m/Y H:i').'')->html(),
            Column::make("Acción", "id")
                ->format(fn($value, $row, Column $column) => view('admin.roles.actions')->withRow($row)->withValue($value)),
        ];
    }

    public function builder(): Builder
    {
        return Role::query()->orderBy('created_at', 'desc');
    }
}
