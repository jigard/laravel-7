<?php

namespace Tests\Feature;

use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     * @test
     */
    public function testBasicTest()
    {
        dd('hi');
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
