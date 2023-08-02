<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
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
}
