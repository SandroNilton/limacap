<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CustomersExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
    public $customers;

  public function __construct($customers) {
      $this->customers = $customers;
  }

  public function headings(): array
  {
    return [
      'Tipo',
      'Nombre',
      'Correo',
      'Estado',
      'Fecha de creación'
    ];
  }

  public function map($invoice): array
  {
    return [
    $invoice->type,
      $invoice->name,
      $invoice->email,
      $invoice->state,
      $invoice->created_at,
    ];
  }

  public function query()
  {
    return User::whereIn('id', $this->customers);
  }
}
