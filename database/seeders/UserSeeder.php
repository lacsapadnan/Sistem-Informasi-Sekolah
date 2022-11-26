<?php

namespace Database\Seeders;

use App\Models\Guru;
use App\Models\Siswa;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $guru = Guru::all();
        $siswa = Siswa::all();

        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@mail.com',
            'password' => Hash::make('admin123'),
            'roles' => 'admin',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('users')->insert([
            'name' => 'Budi Santoso',
            'email' => 'budi@mail.com',
            'password' => Hash::make('budi123'),
            'roles' => 'guru',
            'nip' => '1234567890',
        ]);

        DB::table('users')->insert([
            'name' => 'Gunawan Efendi',
            'email' => 'gunawan@mail.com',
            'password' => Hash::make('gunawan123'),
            'roles' => 'guru',
            'nip' => '0987654321',
        ]);

        DB::table('users')->insert([
            'name' => 'Kevin Hartanto',
            'email' => 'kevin@mail.com',
            'password' => Hash::make('kevin123'),
            'roles' => 'siswa',
            'nis' => '123454321',
        ]);

        DB::table('users')->insert([
            'name' => 'Siska Saraswati',
            'email' => 'siska@mail.com',
            'password' => Hash::make('siska123'),
            'roles' => 'siswa',
            'nis' => '543212345',
        ]);

        // update user_id to guru table as user id
        foreach ($guru as $g) {
            DB::table('gurus')->where('nip', $g->nip)->update([
                'user_id' => DB::table('users')->where('nip', $g->nip)->first()->id
            ]);
        }

        // update user_id to siswa table as user id
        foreach ($siswa as $s) {
            DB::table('siswas')->where('nis', $s->nis)->update([
                'user_id' => DB::table('users')->where('nis', $s->nis)->first()->id
            ]);
        }
    }
}
