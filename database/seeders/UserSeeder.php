<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'id' => 1,
            'name' => 'Master',
            'email' => 'contact@master.com',
        ]);

        User::factory()->create([
            'id' => 2,
            'name' => 'Admin',
            'email' => 'contact@admin.com',
        ]);

        User::factory()->create([
            'id' => 3,
            'name' => 'User',
            'email' => 'contact@user.com',
        ]);
    }
}
