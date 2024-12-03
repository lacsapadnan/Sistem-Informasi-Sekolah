<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengumumanSekolah extends Model
{
    protected $fillable = ['start_at', 'end_at', 'description'];

    protected $cast = [
        'start_at' => 'date',
        'end_at' => 'date'
    ];
}
