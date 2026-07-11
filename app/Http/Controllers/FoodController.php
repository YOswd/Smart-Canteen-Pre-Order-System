<?php

namespace App\Http\Controllers;

use App\Models\Food;

class FoodController extends Controller
{
    public function menu()
    {
        $foods = Food::all();
        return view('food.menu', compact('foods'));
    }
}
