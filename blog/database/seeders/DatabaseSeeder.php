<?php

namespace Database\Seeders;
use App\Models\User;
use App\Models\Category;
use App\Models\Post;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::truncate();
        Category::truncate();
        Post::truncate();

        $user = User::factory()->create();

        $personal = Category::create([
            'name' => 'Personal',
            'slug' => 'personal'
        ]);

        $work = Category::create([
            'name' => 'Work',
            'slug' => 'work'
        ]);

        $hobbies = Category::create([
            'name' => 'Hobbies',
            'slug' => 'hobbies'
        ]);

        Post::create([
            'user_id' => $user->id,
            'category_id' =>$personal->id,
            'title' => 'My Family Post',
            'slug' => 'my-family-post',
            'excerpt' => 'Lorem ipsum dolar sit amet.',
            'body' => '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Animi unde aut qui quo nesciunt, laboriosam corrupti provident optio atque inventore facilis? Expedita enim soluta dolore accusamus cum tempore possimus suscipit!</p>'
        ]);

        Post::create([
            'user_id' => $user->id,
            'category_id' =>$work->id,
            'title' => 'My Work Post',
            'slug' => 'my-work-post',
            'excerpt' => 'Lorem ipsum dolar sit amet.',
            'body' => '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Animi unde aut qui quo nesciunt, laboriosam corrupti provident optio atque inventore facilis? Expedita enim soluta dolore accusamus cum tempore possimus suscipit!</p>'
        ]);

        Post::create([
            'user_id' => $user->id,
            'category_id' =>$hobbies->id,
            'title' => 'My Hobbies Post',
            'slug' => 'my-hobbies-post',
            'excerpt' => 'Lorem ipsum dolar sit amet.',
            'body' => '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Animi unde aut qui quo nesciunt, laboriosam corrupti provident optio atque inventore facilis? Expedita enim soluta dolore accusamus cum tempore possimus suscipit!</p>'
        ]);
    }
}
