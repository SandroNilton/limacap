<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proceduremessagefinish extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'procedure_id',
        'description',
    ];
}
