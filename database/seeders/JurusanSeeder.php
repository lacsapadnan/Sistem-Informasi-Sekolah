<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JurusanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('jurusans')->insert([
            'nama_jurusan' => 'IPA',
        ]);

        DB::table('jurusans')->insert([
            'nama_jurusan' => 'IPS',
        ]);
    }
}
