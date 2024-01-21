<?php

namespace Tests;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ApiTestCase extends TestCase
{
    protected function getToken() {
        $user = User::factory()->create();
        $token = $user->createToken('invoice', []);

//        $data = ['name' => fake()->name(),'email' => fake()->email(),'password' => fake()->password(),];
//        User::create($data);

//        $response = $this->post(uri: '/api/v1/login', data: ['email' => $data['email'], 'password' => $data['password'],]);

        return $token->plainTextToken;
    }

    protected function token() {
        return $this->withToken($this->getToken());
    }
}
