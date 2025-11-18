<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apotek extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_apotek',
        'alamat',
        'telepon',
        'email',
        'sejarah',
        'visi',
        'misi',
        'layanan',
        'jam_operasional', // SINGLE FIELD
        'logo'
    ];
}