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
             "name" => "cursosdesarrolloweb",
             "email" => "app@cursosdesarrolloweb.es",
             "password" => bcrypt("password")
         ]);

         Project::factory()->times(40)->create();
    }
}
