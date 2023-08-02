<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
  public $users;

  public function __construct($users) {
      $this->users = $users;
  }

  public function headings(): array
  {
    return [
      'Nombre',
      'Correo',
      'Área',
      'Estado',
      'Fecha de creación'
    ];
  }

  public function map($invoice): array
  {
    return [
      $invoice->name,
      $invoice->email,
      $invoice->area->name,
      $invoice->state,
      $invoice->created_at,
    ];
  }

  public function query()
  {
    return User::whereIn('id', $this->users);
  }
}
