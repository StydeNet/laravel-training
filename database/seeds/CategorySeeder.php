<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $php = Category::create([
            'title' => 'PHP',
        ]);

        $laravel = Category::create([
            'title' => 'Laravel',
        ]);

        $eloquent = Category::create([
            'title' => 'Eloquent',
        ]);
    }
}
