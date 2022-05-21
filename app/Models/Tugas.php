<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tugas extends Model
{
    use HasFactory;
    protected $fillable = ['judul', 'deskripsi', 'kelas_id', 'guru_id', 'file'];

    public function guru() {
        return $this->belongsTo(Guru::class, 'guru_id');
    }

    public function kelas()
    {
         return $this->belongsTo(Kelas::class, 'kelas_id');
    }

    public function jawaban() {
        return $this->hasMany(Jawaban::class, 'tugas_id');
    }
}
