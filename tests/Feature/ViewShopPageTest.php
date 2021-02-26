<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ViewShopPageTest extends TestCase
{
    /**
     * @test
     * Test Shop Home
     */
    public function shop_page_loads_correctly() {
        //Arrange

        //Act
        $response = $this->get('/');

        //Asserts
        $response->assertStatus(200);
        $response->assertSee('Featured Products');
    }

}
