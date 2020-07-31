<?php

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
        //
        for ($i = 1; $i <= 10; $i++) {
            $rand = rand(10, 1000);
            $pass = 'guru'. $rand;
            DB::table('users')->insert([
                'name' => 'Guru ' . $i,
                'tipe_user' => 'USER', 
                'email' => 'guru' . $i . '@guru.com',
                'password' => Hash::make($pass),
                'temp_password' => $pass
            ]);
        }
    }
}
