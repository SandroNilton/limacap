<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use sirajcse\UniqueIdGenerator\UniqueIdGenerator;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Procedure extends Model
{
    use HasFactory, HasUuids;

    protected $casts = [
        'id' => 'string'
    ];

    public $incrementing = false;
    protected $primaryKey = 'id';
    protected $keyType = 'string';

    protected $fillable = [
      'typeprocedure_id',
      'area_id',
      'description',
      'user_id',
      'admin_id',
      'date',
      'code',
      'serie',
      'state'
    ];

    public function typeprocedure()
    {
      return $this->belongsTo(Typeprocedure::class, 'typeprocedure_id', 'id');
    }

    public function area()
    {
      return $this->belongsTo(Area::class, 'area_id', 'id');
    }

    public function user()
    {
      return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function admin()
    {
      return $this->belongsTo(User::class, 'admin_id', 'id');
    }

    public function state()
    {
      return $this->belongsTo(User::class, 'state', 'id');
    }

    public static function boot() { 
      parent::boot(); 
      self::creating(function ($model) { 
      $prefix = 'CAPRL'.Carbon::now()->year;
      $model->id = UniqueIdGenerator::generate(['table' => 'procedures', 'length' => 15,'prefix' =>$prefix]); 
      }); 
    }

}
