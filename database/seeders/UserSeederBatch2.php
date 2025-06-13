<?php

namespace Database\Seeders;

use App\Models\User; // <-- ESSENCIAL
use Illuminate\Database\Seeder;

class UserSeederBatch2 extends Seeder
{
    public function run(): void
    {
        User::factory()->count(10000)->create();
    }
}
