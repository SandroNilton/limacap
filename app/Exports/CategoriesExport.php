<?php

namespace App\Exports;

use App\Models\Category;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CategoriesExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
  public $categories;

  public function __construct($categories) {
      $this->categories = $categories;
  }

  public function headings(): array
  {
    return [
      'Nombre',
      'Descripción',
      'Estado',
      'Fecha de creación'
    ];
  }

  public function map($invoice): array
  {
    return [
      $invoice->name,
      $invoice->description,
      $invoice->state,
      $invoice->created_at,
    ];
  }

  public function query()
  {
    return Category::whereIn('id', $this->categories);
  }
}
