<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ListProductTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_list_products_success(): void
    {
        $payload  = [];
        $response = $this->withoutMiddleware()->withHeaders(['Accept' => 'application/json'])->getJson(route('products.list'), $payload);
        $response->assertStatus(200);
    }

    public function test_list_products_fail(): void
    {
        $payload  = [];
        $response = $this->withHeaders(['Accept' => 'application/json'])->getJson(route('products.list'), $payload);
        $response->assertStatus(401);
    }
}
