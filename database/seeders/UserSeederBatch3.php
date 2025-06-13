<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeederBatch3 extends Seeder
{
    public function run()
    {
        User::factory()->count(10000)->create();
    }
}
