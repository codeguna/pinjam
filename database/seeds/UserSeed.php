<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password')
        ]);
        $user->assignRole('administrator');
        $user = User::create([
            'name' => 'Demo Bendahara',
            'email' => 'demo.bendahara@mail.com',
            'password' => bcrypt('password')
        ]);
        $user->assignRole('bendahara');
        $user = User::create([
            'name' => 'Demo Ketua',
            'email' => 'demo.ketua@mail.com',
            'password' => bcrypt('password')
        ]);
        $user->assignRole('ketua');

    }
}