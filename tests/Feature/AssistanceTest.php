<?php

namespace Tests\Feature;

use App\Models\Assistance;
use App\Models\Branch;
use App\Models\Customer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AssistanceTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_index()
    {
        // $category = Assistance::factory()->count(5)->create();
        $response = $this->getJson('/api/assistances');
        $response->assertSuccessful();
        // $response->assertStatus(200);
    }

    public function test_new_assistance() //Make income
    {
        $input = '18/05/2022 11:00:02';
        $data = [
            'input' =>$input,
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

    public function test_update_assistance() //Make output
    {
        $assistance = Assistance::factory()->create();
        $input = '18/05/2022 15:00:02';
        $data = [
            'output' => $input
        ];

        $response = $this->patchJson("/api/assistances/{$assistance->getKey()}", $data);
        $response->assertStatus(200);
    }
}
