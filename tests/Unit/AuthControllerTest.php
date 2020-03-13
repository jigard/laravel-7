<?php

namespace Tests\Unit;

use Mockery;
use Tests\TestCase;
use App\Http\Controllers\API\AuthController;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AuthControllerTest extends TestCase
{
    use WithFaker;
    use DatabaseTransactions;
    
    /**
     * setup test environment
     * 
     */
    public function setUp(): void
    {
        $this->mockAuthController = Mockery::mock(AuthController::class)->makePartial();
    }

    /**
     * Clear test environment before start test
     */
    public function tearDown(): void
    {
        parent::tearDown();
    }

    /**
     * Check for method exists or not.
     *
     * @test
     */
    public function method_exists()
    {
        $methodsToCheck = [
            'index',
            'register',
            'token',
        ];

        foreach ($methodsToCheck as $method) {
            $this->checkMethodExist($this->mockAuthController, $method);
        }
    }

    public function checkMethodExist($object, $method)
    {
        $this->assertTrue(
            method_exists($object, $method),
            get_class($object) . ' does not have method ' . $method
        );
    }

    /**
     * Test case for create user successfully
     *
     * @test
     */
    public function tests_create_user_successfully()
    {
        $requestData = [
            'name' => 'abc123',
            'email' => 'abc@gmail.com',
            'password' => '123123123',
            'device_name' => 'android',
        ];
        $this->json('POST', '/api/airlock/register', $requestData)
            ->assertStatus(201)
            ->assertJsonStructure([
                'token'
            ]);
    }

      /**
     * Test case for get user token successfully
     *
     * @test
     */
    public function tests_get_user_token_successfully()
    {
        $requestData = [
            'email' => 'abc@gmail.com',
            'password' => '123123123',
            'device_name' => 'android',
        ];
        $this->json('POST', '/api/airlock/token', $requestData)
            ->assertStatus(201)
            ->assertJsonStructure([
                'token'
            ]);
    }
}
