<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use App\Models\Role;
use App\Models\ProductCategory;

class ProductCreateTest extends TestCase
{
    use RefreshDatabase;
    protected $user;

    public function setUp(): void
    {
        parent::setUp();

        $function = Role::firstOrCreate(['name' => 'admin', 'description' => 'Administrator']);

        $this->user = User::factory()->create([
            'function_id' => $function->id,
        ]);
    }

    private function createProductCategory()
    {
        return ProductCategory::factory()->create([
            'type' => 'Category 1',
        ]);
    }

    /** @test */
    public function it_creates_a_product_successfully()
    {
        Storage::fake('public');

        // Ensure there's a valid category ID in your database (if necessary)
        $this->createProductCategory();

        $productData = [
            'name' => 'Complete Product',
            'price' => 50.00,
            'product_category_id' => 1,
            'amount' => 15,
            'ean' => 12345123,
        ];

        $response = $this->actingAs($this->user)
            ->post(route('products.store'), $productData);

        // Check if the redirect goes to the correct route
        $response->assertRedirect(route('products'))
            ->assertSessionHas('success', 'Product succesvol aangemaakt!');

        // Check if the product was created
        $this->assertDatabaseHas('products', [
            'name' => $productData['name'],
            'price' => $productData['price'],
        ]);
    }


    /** @test */
    public function it_updates_a_product_successfully()
    {
        Storage::fake('public');

        // Ensure there's a valid category ID in your database (if necessary)
        $category = $this->createProductCategory();

        // Create a product to update
        $product = Product::factory()->create([
            'name' => 'Old Product',
            'price' => 30.00,
            'product_category_id' => $category->id,
            'amount' => 10,
            'ean' => 12345678,
        ]);

        $updatedProductData = [
            'name' => 'Updated Product',
            'price' => 60.00,
            'product_category_id' => $category->id,
            'amount' => 20,
            'ean' => 87654321,
        ];

        $response = $this->actingAs($this->user)
            ->put(route('products.update', $product->id), $updatedProductData);

        // Check if the redirect goes to the correct route
        $response->assertRedirect(route('products'))
            ->assertSessionHas('success', 'Product succesvol bewerkt!');

        // Check if the product was updated
        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'name' => $updatedProductData['name'],
            'price' => $updatedProductData['price'],
        ]);
    }


    /** @test */
    public function it_deletes_a_product_successfully() {
        Storage::fake('public');

        // Ensure there's a valid category ID in your database (if necessary)
        $category = $this->createProductCategory();

        // Create a product to delete
        $product = Product::factory()->create([
            'name' => 'Product to Delete',
            'price' => 30.00,
            'product_category_id' => $category->id,
            'amount' => 10,
            'ean' => 12345678,
        ]);

        $response = $this->actingAs($this->user)
            ->delete(route('products.destroy', $product->id));

        // Check if the redirect goes to the correct route
        $response->assertRedirect(route('products'));

        // Check if the product was deleted
        $this->assertDatabaseMissing('products', [
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
        ]);
    }
}
