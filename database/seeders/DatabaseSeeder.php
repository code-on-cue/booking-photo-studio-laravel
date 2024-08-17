<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Role::create(['name' => 'Administrator']);
        Role::create(['name' => 'Customer']);
        // User::factory(10)->create();
        $this->call(ConfigSeeder::class);
        User::factory()->create([
            'role_id' => 1,
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
