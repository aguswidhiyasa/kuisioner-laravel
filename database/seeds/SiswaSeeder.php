<?php

use Illuminate\Database\Seeder;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        for ($i = 0; $i < 30; $i++) {
            $rand = rand(10, 1000);
            $pass = 'siswa' . $rand;
            \Illuminate\Support\Facades\DB::table('users')->insert([
                'name' => 'Siswa ' . $i,
                'tipe_user' => 'USER',
                'email' => 'siswa' . $i . "@siswa.com",
                'password' => \Illuminate\Support\Facades\Hash::make($pass),
                'temp_password' => $pass
            ]);
        }
    }
}
