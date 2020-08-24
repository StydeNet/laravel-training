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
        $laravel = Category::create([
            'title' => 'Laravel',
        ]);

        $eloquent = Category::create([
            'title' => 'Eloquent',
        ]);
    }
}
