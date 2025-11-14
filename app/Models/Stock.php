<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $fillable = [
        'medicine_id',
        'quantity',
    ];

    // Relasi dengan Medicine
    public function medicine()
    {
        return $this->belongsTo(Medicine::class);
    }
}