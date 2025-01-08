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
        // Maak een testgebruiker aan
        $user = User::factory()->create();

        // Meld de gebruiker aan
        $this->actingAs($user);

        // Maak een testklant en testproduct aan
        $customer = Customer::factory()->create();
        $product = Product::factory()->create(['price' => 100]);

        // Testdata voor een offerte
        $data = [
            'customer_id' => $customer->id,
            'date' => now()->toDateString(),
            'product_id' => [$product->id],
            'amount' => [2],
        ];

        // Voer een POST-aanvraag uit om een offerte aan te maken
        $response = $this->post(route('proposals.store'), $data);

        // Controleer of de offerte correct is aangemaakt
        $response->assertRedirect(route('proposals.show', 1));
        $this->assertDatabaseHas('proposals', [
            'customer_id' => $customer->id,
            'user_id' => $user->id,
        ]);

        // Controleer of de prijsregel correct is aangemaakt
        $this->assertDatabaseHas('proposal_price_lines', [
            'product_id' => $product->id,
            'price' => 100,
            'amount' => 2,
        ]);
    }
}
