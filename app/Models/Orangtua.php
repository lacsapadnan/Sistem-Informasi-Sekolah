<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orangtua extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'alamat', 'no_telp'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function siswas()
    {
        return $this->belongsToMany(Siswa::class, 'orangtua_siswas', 'orangtua_id', 'siswa_id');
    }
}
