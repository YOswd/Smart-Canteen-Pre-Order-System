<?php

namespace Database\Seeders;

use App\Models\Food;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    Food::create([
        'name' => 'Chicken Burger',
        'description' => 'Juicy grilled chicken burger',
        'price' => 180,
        'stock' => 20,
        'image' => 'burger.jpg',
        'available' => true,
    ]);

    Food::create([
        'name' => 'Fried Rice',
        'description' => 'Special fried rice',
        'price' => 220,
        'stock' => 20,
        'image' => 'fried_rice.jpg',
        'available' => true,
    ]);

    Food::create([
        'name' => 'Cold Drinks',
        'description' => 'Refreshing beverage',
        'price' => 50,
        'stock' => 20,
        'image' => 'drink.jpg',
        'available' => true,
    ]);
}
}
