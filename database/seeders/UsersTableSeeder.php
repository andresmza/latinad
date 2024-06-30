<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Test User 1',
                'email' => 'test1@latinad.com',
                'password' => Hash::make('#Password1'),
            ],
            [
                'name' => 'Test User 2',
                'email' => 'test2@latinad.com',
                'password' => Hash::make('#Password2'),
            ],
            [
                'name' => 'Test User 3',
                'email' => 'test3@latinad.com',
                'password' => Hash::make('#Password3'),
            ],
            [
                'name' => 'Test User 4',
                'email' => 'test4@latinad.com',
                'password' => Hash::make('#Password4'),
            ],
            [
                'name' => 'Test User 5',
                'email' => 'test5@latinad.com',
                'password' => Hash::make('#Password5'),
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
