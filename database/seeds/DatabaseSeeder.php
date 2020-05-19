<?php

use App\Models\Category;
use App\Models\Product;
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
        // $this->call(UsersTableSeeder::class);

        factory(Category::class, 10)->create()->each(function($category){
        	$category->products()->saveMany(factory(Product::class, 3)->make());
        });
    }
}
