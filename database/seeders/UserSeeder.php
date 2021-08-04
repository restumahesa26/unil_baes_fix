<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Mufti Restu Mahesa',
            'email' => 'mufti.restumahesa@gmail.com',
            'password' => Hash::make('password'),
            'pekerjaan' => 'Mahasiswa',
            'jenis_kelamin' => 'Laki-Laki',
            'no_hp' => '08117482512'
        ]);
    }
}
