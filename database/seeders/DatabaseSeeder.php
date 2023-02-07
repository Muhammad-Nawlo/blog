<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
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
        $user1 = User::factory()->create([
            'name' => 'Muhammad Nawlo',
            'username' => 'muahmmad_nawlo'
        ]);
        $user2 = User::factory()->create([
            'name' => 'Sally Ismael',
            'username' => 'sally_ismael'
        ]);

        $heaven = Category::factory()->create([
            'name' => 'Heaven',
            'slug' => 'heaven'
        ]);

        Post::factory(10)->create([
            'user_id' => $user1->id,
            'category_id' => $heaven->id,
        ]);
        Post::factory(10)->create([
            'user_id' => $user2->id,
            'category_id' => $heaven->id,
        ]);
        Post::factory(10)->create();
    }
}
