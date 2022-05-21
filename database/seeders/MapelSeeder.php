<?php

namespace Database\Seeders;

use App\Models\Mapel;
use Illuminate\Database\Seeder;

class MapelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $mapel = [
            [
            'nama_mapel' => 'Pengantar Ekonomi Bisnis',
            'jurusan' => 'Administrasi Perkantoran'
            ],
            [
            'nama_mapel' => 'Kearsipan',
            'jurusan' => 'Administrasi Perkantoran'
            ],
            [
            'nama_mapel' => 'Akuntansi Anggaran',
            'jurusan' => 'Akuntansi'
            ],
            [
            'nama_mapel' => 'Akuntansi Pemerintah',
            'jurusan' => 'Akuntansi'
            ],
        ];

        Mapel::insert($mapel);
    }
}
