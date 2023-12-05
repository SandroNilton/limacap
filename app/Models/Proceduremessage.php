<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proceduremessage extends Model
{
    use HasFactory, HasUuids;

    protected $casts = [
        'id' => 'string'
    ];

    protected $fillable = [
        'procedure_id',
        'user_id',
        'description',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
