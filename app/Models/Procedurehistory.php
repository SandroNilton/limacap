<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Procedurehistory extends Model
{
    use HasFactory, HasUuids;

    protected $casts = [
        'id' => 'string'
    ];

    protected $fillable = [
      'procedure_id',
      'area_id',
      'admin_id',
      'action',
      'state'
    ];

    public function area()
    {
      return $this->belongsTo(Area::class, 'area_id', 'id');
    }
}
