<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requirement extends Model
{
    use HasFactory, HasUuids;

    protected $casts = [
      'id' => 'string'
    ];

    protected $fillable = [
      'name',
      'description',
      'state',
    ];

    public function typeprocedures()
    {
      return $this->belongsToMany(Typeprocedure::class);
    }
}
