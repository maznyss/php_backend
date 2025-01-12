<?php

namespace Database\Seeders;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    public function run()
    {
        $users = User::all();
        $categories = Category::all();

        foreach ($users as $user) {
            Post::create([
                'user_id' => $user->id,
                'category_id' => $categories->random()->id,
                'title' => 'Sample Post Title by ' . $user->username,
                'description' => 'This is a sample description for a post created by ' . $user->username,
                'tags' => 'sample,example',
            ]);
        }
    }
}
