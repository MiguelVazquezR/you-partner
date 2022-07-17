<?php

namespace Database\Seeders;

use App\Models\Homework;
use App\Models\SchoolSubject;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        
        User::factory()->create([
            'name' => 'Miguel Vázquez',
            'email' => 'miguel@t.com',
            'password' => bcrypt('123123123'),
        ]);
        
        User::factory(10)->create();
        SchoolSubject::factory(10)->create();
        Homework::factory(25)->create();

    }
}
