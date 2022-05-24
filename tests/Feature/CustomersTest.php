<?php

namespace Tests\Feature;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class CustomersTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    protected function setUp(): void
    {
        parent::setUp();
        Sanctum::actingAs(
            User::factory()->create()
        );
    }


    public function test_customers_index()
    {
        // $category = Assistance::factory()->count(5)->create();
        $response = $this->getJson('/api/customers');
        $response->assertSuccessful();
        // $response->assertStatus(200);
    }
    public function test_create_new_customner() //Make income
    {
        $input = '18/05/2022 11:00:02';
        $data = [
            'input' => $input,
            'customer_id' => function () {
                return  Customer::query()->inRandomOrder()->first()->id;
            },
            'branch_id' => function () {
                return  Branch::query()->inRandomOrder()->first()->id;
            },
        ];

        $response = $this->postJson('/api/assistances', $data);
        $response->assertStatus(200);
    }
}
