<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Food;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class FoodCrudTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutVite();
    }

    public function test_admin_can_access_food_management()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $response = $this->actingAs($admin)->get('/manage-food');
        $response->assertStatus(200);
    }

    public function test_non_admin_cannot_access_food_management()
    {
        $user = User::factory()->create(['role' => 'student']);
        $response = $this->actingAs($user)->get('/manage-food');
        $response->assertStatus(403);
    }

    public function test_admin_can_add_food()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        Storage::fake('public');

        $file = UploadedFile::fake()->image('food.jpg');

        $response = $this->actingAs($admin)->post('/manage-food', [
            'name' => 'Burger',
            'description' => 'A delicious burger',
            'price' => 5.99,
            'stock' => 10,
            'image' => $file,
            'available' => '1',
        ]);

        $response->assertRedirect('/manage-food');
        $this->assertDatabaseHas('foods', ['name' => 'Burger']);
        $food = Food::first();
        Storage::disk('public')->assertExists($food->image);
    }

    public function test_admin_can_edit_food()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $food = Food::create([
            'name' => 'Pizza',
            'price' => 10.99,
            'stock' => 5,
            'available' => true,
        ]);

        $response = $this->actingAs($admin)->put('/manage-food/' . $food->id, [
            'name' => 'Updated Pizza',
            'price' => 12.99,
            'stock' => 20,
        ]);

        $response->assertRedirect('/manage-food');
        $this->assertDatabaseHas('foods', ['name' => 'Updated Pizza', 'price' => 12.99]);
    }

    public function test_admin_can_delete_food()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $food = Food::create([
            'name' => 'Salad',
            'price' => 4.99,
            'stock' => 15,
            'available' => true,
        ]);

        $response = $this->actingAs($admin)->delete('/manage-food/' . $food->id);
        $response->assertRedirect('/manage-food');
        $this->assertDatabaseMissing('foods', ['name' => 'Salad']);
    }
}
