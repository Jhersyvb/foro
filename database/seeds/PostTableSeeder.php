<?php

use Illuminate\Database\Seeder;
use App\Category;
use App\Post;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = Category::select('id')->get();

        foreach (range(1, 100) as $i) {
            factory(Post::class)->create([
                'category_id' => $categories->random()->id
            ]);
        }
    }
}
