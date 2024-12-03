<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(JurusanSeeder::class);
        $this->call(MapelSeeder::class);
        $this->call(GuruSeeder::class);
        $this->call(KelasSeeder::class);
        $this->call(JadwalSeeder::class);
        $this->call(SiswaSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(PengaturanSeeder::class);
    }
}
