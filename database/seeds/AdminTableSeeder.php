<?php

use Illuminate\Database\Seeder;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\User::class)->create([
            'first_name' => 'Jhersy',
            'last_name' => 'Valer Bejarano',
            'username' => 'boster',
            'email' => 'hola@jhersy.com',
            'role' => 'admin'
        ]);
    }
}
