<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        factory(\App\Models\User::class, 1)->create([
            'email' => 'Falco.sy',
            'password' => bcrypt('secret'),
            'name' => 'falco'
        ]);
    }
}
