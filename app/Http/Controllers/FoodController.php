<?php

namespace App\Http\Controllers;

use App\Models\Food;
use Illuminate\Http\Request;

class FoodController extends Controller
{
    public function menu(Request $request)
    {
        if ($request->filled('search')) {

            $foods = Food::where('name', 'like', '%' . $request->search . '%')->get();

            if ($foods->isEmpty()) {
            return redirect()->route('menu')
                ->with('warning', 'No food found matching "' . $request->search . '".');
        }

            return view('food.menu', compact('foods'));
        }

        $foods = Food::all();

        return view('food.menu', compact('foods'));
    }
}