<?php

namespace App\Exports;

use App\Models\Area;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AreasExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
  public $areas;

  public function __construct($areas) {
      $this->areas = $areas;
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
    return Area::whereIn('id', $this->areas);
  }
}
