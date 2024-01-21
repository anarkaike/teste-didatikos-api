<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Tests\ApiTestCase;
use Tests\CreatesApplication;

class UserTest extends ApiTestCase
{
    use CreatesApplication;
    use RefreshDatabase;

    private $fields = ['id', 'name', 'email', 'created_at', 'updated_at',];

    public function setUp(): void
    {
        parent::setUp();
        Artisan::call(command: 'migrate');
        Artisan::call(command: 'migrate:fresh');
    }

    /**
     * Testando listagem de usuários
     * Verifica um retorno com sucesso para o end point GET /users
     *
     * @test
     */
    public function check_list_return_with_success(): void
    {
        $users = User::factory(count: 5)->create();
        $response = $this->token()->get(uri: '/api/v1/users');
        $response->assertStatus(status: 200);
        $response->assertJsonPath(path: "message", expect: trans(key: 'messages.users.listing_successfully'));
        $response->assertJsonCount(count: 6, key: 'data');
        $response->assertJsonStructure([
            'success',
            'message',
            'data' => [$this->fields],
            'metadata'
        ]);

        foreach ($users as $k => $user) {
            $response->assertJsonPath(path: "data.$k.name", expect: $user->name);
        }
    }

    /**
     * Testando criação de usuário
     * Verifica um retorno com sucesso para o end point POST /users
     *
     * @test
     */
    public function check_create_return_with_success(): void
    {
        $user = User::factory()->definition();
        $response = $this->token()->post(uri: '/api/v1/users', data: $user);
        $response->assertStatus(status: 200);
        $response->assertJsonPath(path: "message", expect: trans(key: 'messages.users.creating_successfully'));
        $response->assertJsonStructure([
            'success',
            'message',
            'data' => $this->fields,
            'metadata'
        ]);

        $response->assertJsonPath(path: "data.name", expect: $user['name']);
    }

    /**
     * Testando atualização de usuário
     * Verifica um retorno com sucesso para o end point PUT /users/{id}
     *
     * @test
     */
    public function check_update_return_with_success(): void
    {
        $user = User::factory()->create();
        $userNewData = [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'password' => fake()->password(),
        ];
        $response = $this->token()->put(uri: '/api/v1/users/' . $user->id, data: $userNewData);
        $response->assertStatus(status: 200);
        $response->assertJsonPath(path: "message", expect: trans(key: 'messages.users.updating_successfully'));
        $response->assertJsonStructure([
            'success',
            'message',
            'data' => $this->fields,
            'metadata'
        ]);

        $response->assertJsonPath(path: "data.name", expect: $userNewData['name']);
        $response->assertJsonPath(path: "data.email", expect: $userNewData['email']);
    }

    /**
     * Testando exclusão de usuário
     * Verifica um retorno com sucesso para o end point DELETE /users/{id}
     *
     * @test
     */
    public function check_delete_return_with_success(): void
    {
        $user = User::factory()->create();
        $response = $this->token()->delete(uri: '/api/v1/users/' . $user->id);
        $response->assertStatus(status: 200);
        $response->assertJsonPath(path: "message", expect: trans(key: 'messages.users.deleting_successfully'));
        $response->assertJsonStructure([
            'success',
            'message',
            'data',
            'metadata'
        ]);

        $this->assertNull(User::find($user->id));
    }
}
