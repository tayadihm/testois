<?php

use Illuminate\Database\Seeder;
use App\User;

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
            'nim'       => '4817070973',
        	'nama_mhs'  => 'Hidayat',
        	'email'     => 'hidayat@gmail.com',
        	'password'  => bcrypt('hidayat'),
            'no_telfon' => '087770821295',
        ]);
    }
}
