<?php

namespace App\Http\Livewire\Admin\Categories;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateTimeFilter;
use App\Exports\CategoriesExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Category;

class CategoryTable extends DataTableComponent
{
    protected $model = Category::class;

    public function filters(): array
    {
        return [
            DateTimeFilter::make('Creación desde')->filter(function(Builder $builder, string $value) { $builder->where('categories.created_at', '>=', $value); }),
            DateTimeFilter::make('Creación a')->filter(function(Builder $builder, string $value) { $builder->where('categories.created_at', '<=', $value); }),
            SelectFilter::make('Estado')
              ->setFilterPillTitle('Estado')
              ->setFilterPillValues(['activo' => 'Activo', 'inactivo' => 'Inactivo',])
              ->options(['' => 'Todo', 'activo' => 'Activo', 'inactivo' => 'Inactivo',])
              ->filter(function(Builder $builder, string $value) {
                if ($value === 'activo') {
                    $builder->where('categories.state', 'Activo');
                } elseif ($value === 'inactivo') {
                    $builder->where('categories.state', 'Inactivo');
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
        Category::whereIn('id', $this->getSelected())->update(['state' => 'Activo']);
        $this->notice('Se activo correctamente', 'success');
        $this->clearSelected();
    }

    public function inactivate(): void
    {
        Category::whereIn('id', $this->getSelected())->update(['state' => 'Inactivo']);
        $this->notice('Se inactivo correctamente', 'alert');
        $this->clearSelected();
    }

    public function export()
    {
        $categories = $this->getSelected();
        $this->clearSelected();
        $this->notice('Se exporto correctamente', 'info');
        return Excel::download(new CategoriesExport($categories), 'categorías.xlsx');
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
                ->format(fn($value, $row, Column $column) => view('admin.categories.actions')->withRow($row)->withValue($value)),
        ];
    }

    public function builder(): Builder
    {
        return Category::query()->orderBy('created_at', 'desc');
    }
}
