<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
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

    protected function status(): Attribute
    {
        return new Attribute(
            get: fn ($value) => ["Inactivo", "Activo"][$this->state],
        );
    }
}
