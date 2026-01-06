<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HobbySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $hobbies = ['Reading', 'Gaming', 'Cooking', 'Traveling', 'Photography', 'Painting', 'Dancing', 'Singing'];
        
        foreach ($hobbies as $hobby) {
            \App\Models\Hobby::create(['name' => $hobby]);
        }
    }
}
