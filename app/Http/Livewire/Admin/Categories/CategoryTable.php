<?php

namespace App\Http\Livewire\Admin\Categories;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateTimeFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateFilter;
use App\Exports\CategoriesExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Typeprocedure;
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
            $builder->where('categories.state', 'activo');
        } elseif ($value === 'inactivo') {
            $builder->where('categories.state', 'inactivo');
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
    Category::whereIn('id', $this->getSelected())->update(['state' => 'activo']);
    $this->notice('Se activo correctamente', 'success');
    $this->clearSelected();
  }

  public function deactivate()
  {
    Category::whereIn('id', $this->getSelected())->update(['state' => 'inactivo']);
    $this->notice('Se desactivo correctamente', 'alert');
    $this->clearSelected();
  }

  public function deleteCategory($value)
  {
    $category_in_typeprocedure = Typeprocedure::where([['category_id', '=', $value]])->get();
    if($category_in_typeprocedure->count() > 0){
      $this->notice('La categoría se encuentra en uso actualmente', 'info');
    } else {
      Category::where('id', $value)->delete();
      $this->notice('Se eliminó la categoría correctamente', 'alert');
    }
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
        ->format(fn($value, $row, Column $column) => view('admin.categories.actions')->withRow($row)->withValue($value)),
    ];
  }

  public function builder(): Builder
  {
    return Category::query()->orderBy('created_at', 'desc');
  }
}
