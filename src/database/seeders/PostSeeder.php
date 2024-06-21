<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Database\Factories\PostFactory;
use Database\Factories\UserFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Post::factory(1000)->for(User::factory()->state([
            'name'  => 'tige'
        ]))->create();
    }
}
