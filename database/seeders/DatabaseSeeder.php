<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
         User::factory()->times(1)->create([
             "name" => "siulacio",
             "email" => "siulacio@hotmail.com",
             "password" => bcrypt("12345678")
         ]);

         Project::factory()->times(40)->create();
    }
}
