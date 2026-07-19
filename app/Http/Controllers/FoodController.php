<?php

namespace App\Http\Controllers;

use App\Models\Food;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

class FoodController extends Controller
{
    // Display the food menu and handle food search requests
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

    public function index()
    {
        $foods = Food::latest()->get();
        return view('food.index', compact('foods'));
    }

    public function create()
    {
        return view('food.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|max:2048',
            'available' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('foods', 'public');
        } else {
            $validated['image'] = 'default.jpg';
        }

        $validated['available'] = $request->has('available') ? true : false;

        Food::create($validated);

        return redirect()->route('manage-food.index')->with('success', 'Food added successfully.');
    }

    public function edit(Food $manage_food)
    {
        return view('food.edit', ['food' => $manage_food]);
    }

    public function update(Request $request, Food $manage_food)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($manage_food->image && $manage_food->image !== 'default.jpg') {
                Storage::disk('public')->delete($manage_food->image);
            }
            $validated['image'] = $request->file('image')->store('foods', 'public');
        }

        $validated['available'] = $request->has('available') ? true : false;

        $manage_food->update($validated);

        return redirect()->route('manage-food.index')->with('success', 'Food updated successfully.');
    }

    public function destroy(Food $manage_food)
    {
        if ($manage_food->image && $manage_food->image !== 'default.jpg') {
            Storage::disk('public')->delete($manage_food->image);
        }
        $manage_food->delete();

        return redirect()->route('manage-food.index')->with('success', 'Food deleted successfully.');
    }
}