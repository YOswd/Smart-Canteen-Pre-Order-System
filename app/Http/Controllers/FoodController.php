<?php

namespace App\Http\Controllers;

use App\Models\Food;
use Illuminate\Http\Request;

class FoodController extends Controller
{
    // Display the food menu and handle food search requests
    public function menu(Request $request)
    {
        // Check if the user has entered a search keyword
        if ($request->filled('search')) {

            // Search foods whose name contains the given keyword
            $foods = Food::where('name', 'like', '%' . $request->search . '%')->get();

            // If no matching food is found, redirect back with a warning message
            if ($foods->isEmpty()) {
                return redirect()->route('menu')
                    ->with('warning', 'No food found matching "' . $request->search . '".');
            }

            // Return the menu view with the searched food items
            return view('food.menu', compact('foods'));
        }

        // If no search is performed, retrieve all available foods
        $foods = Food::all();

        // Return the menu view with all food items
        return view('food.menu', compact('foods'));
    }
}