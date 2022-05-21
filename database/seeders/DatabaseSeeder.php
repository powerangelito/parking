<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\car;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(1)->create([
            'name' => 'Angel Alvarez',
            'username' => 'angel.alvarez',
            'email' => 'angel.alvarez.lozano@outlook.com'
        ]);
        car::factory(6)->create();
    }
}
