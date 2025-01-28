<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;


    /** @test */
<<<<<<< Updated upstream
    public function it_rejects_a_product_with_empty_name() 
=======
    public function it_rejects_a_product_with_empty_name()  
>>>>>>> Stashed changes
    {
        $response = $this->post(route('products.store'), [
            'name' => '',
            'price' => 50,
            'product_category_id' => 1,
            'amount' => 10,
            'ean' => 12345123,
        ]);

        $response->assertSessionHasErrors(['name']);
    }

    /** @test */
    public function it_rejects_a_product_with_invalid_ean() 
    {
        $response = $this->post(route('products.store'), [
            'name' => 'Invalid EAN Product',
            'price' => 50,
            'product_category_id' => 1,
            'amount' => 10,
            'ean' => 'invalid-ean',
        ]);

        $response->assertSessionHasErrors(['ean']);
    }

    /** @test */
    public function it_rejects_a_product_with_price_in_minus() 
    {
        $response = $this->post(route('products.store'), [
            'name' => 'Expensive Product',
            'price' => -999999999.99,
            'product_category_id' => 1,
            'amount' => 10,
            'ean' => 12345123,
        ]);

        $response->assertSessionHasErrors(['price']);
    }

    /** @test */
<<<<<<< Updated upstream
    public function it_rejects_product_with_extremely_long_name()
=======
    public function it_rejects_product_with_extremely_long_name() 
>>>>>>> Stashed changes
    {
        $longName = str_repeat('A', 256); 

        $response = $this->post(route('products.store'), [
            'name' => $longName,
            'price' => 100,
            'product_category_id' => 1,
            'amount' => 10,
            'ean' => 12345123,
        ]);

        $response->assertSessionHasErrors(['name']);
    }

    /** @test */
    public function it_rejects_a_product_with_empty_category_id()
    {
        $response = $this->post(route('products.store'), [
            'name' => 'Product Without Category',
            'price' => 50,
            'product_category_id' => null,
            'amount' => 10,
            'ean' => 12345123,
        ]);

        $response->assertSessionHasErrors(['product_category_id']);
    }

    /** @test */
    public function it_rejects_a_product_with_empty_amount()
    {
        $response = $this->post(route('products.store'), [
            'name' => 'Product Without Amount',
            'price' => 50,
            'product_category_id' => 1,
            'amount' => null,
            'ean' => 12345123,
        ]);

        $response->assertSessionHasErrors(['amount']);
    }

    /** @test */
    public function it_rejects_a_product_with_empty_ean()
    {
        $response = $this->post(route('products.store'), [
            'name' => 'Product Without EAN',
            'price' => 50,
            'product_category_id' => 1,
            'amount' => 10,
            'ean' => null,
        ]);

        $response->assertSessionHasErrors(['ean']);
    }
}
