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
        $arrayOfUsers = [
            ['name' => 'Master', 'email' => 'contact@master.com'],
            ['name' => 'Admin', 'email' => 'contact@admin.com'],
            ['name' => 'User', 'email' => 'contact@user.com'],
        ];

        $users = collect($arrayOfUsers)->map(function ($user) {
            return ['name' => $user['name'], 'email' => $user['email']];
        });

        User::factory()->createMany($users->toArray());
    }
}
