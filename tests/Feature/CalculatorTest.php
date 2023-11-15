<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CalculatorTest extends TestCase
{
    protected User $user;

    public function setUp(): void
    {
        // Ensure that the test is properly bootstrapping the server-side application
        parent::setUp();

        // Create a user to use for routes that require authentication
        $this->user = User::factory()->create();
    }


    /**
     * A basic feature test example.
     */
    public function test_integer_addition(): void
    {
        $url = route('api.calculator.add');
        $response = $this->postJson($url, [
            'x' => 2,
            'y' => 6
        ]);

        $response->assertJsonFragment([
            'result' => 8
        ]);
    }

    public function test_float_addition()
    {
        $url = route('api.calculator.add');
        $response = $this->postJson($url, [
            'x' => 2.3,
            'y' => 6.123
        ]);

        $response->assertJsonFragment([
            'result' => 8.423
        ]);
    }

    public function test_unauthenticated_user_cannot_multiply()
    {
        $url = route('api.calculator.multiply');
        $this->postJson($url, [
            'x' => 5,
            'y' => 4
        ])->assertUnauthorized();
    }

    public function test_rachel_can_divide()
    {
        $rachelEmail = 'rachel@countdown.com';
        $rachel = User::where('email', $rachelEmail)->first();
        
        if (!$rachel) 
            $rachel = User::factory()->create([
                'email' => $rachelEmail
            ]);

        $this
            ->actingAs($rachel)
            ->postJson(route('api.calculator.divide'), ['x' => 10, 'y' => 2])
            ->assertOk();

        $this
            ->actingAs($this->user)
            ->postJson(route('api.calculator.divide'), ['x' => 10, 'y' => 2])
            ->assertForbidden();
    }

    public function test_integer_multiplication()
    {
        $url = route('api.calculator.multiply');
        $response = $this->actingAs($this->user)->postJson($url, [
            'x' => 5,
            'y' => 4
        ]);
        $response->assertOk();

        $response->assertJsonFragment([
            'result' => 20
        ]);
    }
}
