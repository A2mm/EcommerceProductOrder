<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateProductTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_create_products_success(): void
    {
        $payload  = $this->productData();
        $response = $this->withoutMiddleware()->withHeaders(['Accept' => 'application/json'])->postJson(route('products.create'), $payload);
        $response->assertStatus(201);
    }

    public function test_create_products_failed_validation(): void
    {
        $payload  = [];
        $response = $this->withoutMiddleware()->withHeaders(['Accept' => 'application/json'])->postJson(route('products.create'), $payload);
        $response->assertStatus(422);
    }

    public function test_create_products_fail(): void
    {
        $payload  = [];
        $response = $this->withHeaders(['Accept' => 'application/json'])->postJson(route('products.create'), $payload);
        $response->assertStatus(401);
    }

    private function productData(): array
    {
        return [
            'name'     => 'Test',
            'price'    => 100,
            'in_stock' => 10,
        ];
    }
}
