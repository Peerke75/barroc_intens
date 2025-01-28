<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Proposal;
use App\Models\ProposalPriceLine;

class ProposalTest extends TestCase
{
    use RefreshDatabase;

    #[\PHPUnit\Framework\Attributes\Test]
    public function a_user_can_create_a_proposal()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $customer = Customer::factory()->create();
        $product = Product::factory()->create(['price' => 100]);

        $data = [
            'customer_id' => $customer->id,
            'date' => now()->toDateString(),
            'product_id' => [$product->id],
            'amount' => [2],
        ];

        $response = $this->post(route('proposals.store'), $data);

        $response->assertRedirect(route('proposals.show', 1));
        $this->assertDatabaseHas('proposals', [
            'customer_id' => $customer->id,
            'user_id' => $user->id,
        ]);

        $this->assertDatabaseHas('proposal_price_lines', [
            'product_id' => $product->id,
            'price' => 100,
            'amount' => 2,
        ]);
    }
}
