<?php

namespace App\Exports;

use App\Models\Typeprocedure;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TypeproceduresExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
  public $typeprocedures;

  public function __construct($typeprocedures) {
    $this->typeprocedures = $typeprocedures;
  }

  public function headings(): array
  {
    return [
      'Nombre',
      'Descripcion',
      'Área',
      'Categoría',
      'Estado',
      'Fecha de creación'
    ];
  }

  public function map($invoice): array
  {
    return [
      $invoice->name,
      $invoice->description,
      $invoice->area->name,
      $invoice->category->name,
      $invoice->state,
      $invoice->created_at,
    ];
  }

  public function query()
  {
    return Typeprocedure::whereIn('id', $this->typeprocedures);
  }
}
