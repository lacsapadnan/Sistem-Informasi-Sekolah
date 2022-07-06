<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    use HasFactory;
    protected $table = 'jurusans';

    protected $fillable = [
        'nama_jurusan',
    ];

    public function mapel()
    {
        return $this->hasMany(Mapel::class);
    }
}
