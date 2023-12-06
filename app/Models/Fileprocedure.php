<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Fileprocedure extends Model
{
    use HasFactory, HasUuids;

    protected $casts = [
        'id' => 'string'
    ];

    protected $fillable = [
      'procedure_id',
      'requirement_id',
      'name',
      'file',
      'state',
    ];

    public function requirements()
    {
      return $this->belongsToMany(Requirement::class);
    }

    protected function status(): Attribute
    {
        return new Attribute(
            get: fn ($value) => [100 => "Sin verificar", 101 => "Aceptado", 102 =>"Rechazado", 2 => "Observado", 3 => "Revisado", 4 => "Aprobado", 5 => "Cancelado"][$this->state],
        );
    }
}
