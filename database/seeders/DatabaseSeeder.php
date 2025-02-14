<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Task;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $user = [
            [
                'name' => 'Admin',
                'email' => 'admin@mail.com',
                'password' => bcrypt('1234'),
                'status' => 'ACTIVE',
            ],
        ];

        foreach ($user as $item) {
            User::create($item);
        }

        $task = [
            [
                'name' => 'Task 1',
                'status' => 'PENDING',
            ],
            [
                'name' => 'Task 2',
                'status' => 'COMPLETED',
            ],
        ];

        foreach ($task as $item) {
            Task::create($item);
        }
    }
}
