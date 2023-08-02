<?php

namespace App\Exports;

use App\Models\Requirement;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RequirementsExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
  public $requirements;

  public function __construct($requirements) {
      $this->requirements = $requirements;
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
    return Requirement::whereIn('id', $this->requirements);
  }
}
