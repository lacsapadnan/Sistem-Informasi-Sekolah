<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $fillable = ['nis', 'nama', 'kelas_id', 'telp', 'alamat', 'foto'];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }

    public function orangtua()
    {
        return $this->belongsToMany(Orangtua::class, 'orangtua_siswas', 'siswa_id', 'orangtua_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
