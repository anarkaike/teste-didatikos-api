<?php

namespace Tests\Unit;

use Tests\CreatesApplication;
use PHPUnit\Framework\TestCase;
use Illuminate\{
    Foundation\Testing\RefreshDatabase,
    Support\Facades\Artisan,
};
use App\Models\User;
use App\Actions\Users\{
    DeleteUser,
    StoreUser,
    UpdateUser,
};


class UserActionsTest extends TestCase
{
    use CreatesApplication;
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->createApplication();
        Artisan::call(command: 'migrate');
        Artisan::call(command: 'migrate:fresh');
    }

    public function test_store_user_successfully()
    {
        $user = User::factory()->definition();

        $storeUserAction = new StoreUser();
        $createdUser = $storeUserAction->handler(...$user);

        $this->assertInstanceOf(User::class, $createdUser);
        $this->assertEquals($user['name'], $createdUser->name);
        $this->assertEquals($user['email'], $createdUser->email);
    }

    public function test_store_user_exception()
    {
        $user = [];
        $storeUserAction = new StoreUser();

        $this->expectException(\Exception::class);

        $storeUserAction->handler(...$user);
    }

    public function test_update_user_successfully()
    {
        $user = User::factory()->create()->toArray();

        $user['name'] = fake()->name() . ' new name';
        $user['email'] = fake()->email();

        $updateUserAction = new UpdateUser();
        $updatedUser = $updateUserAction->handler(...$user);

        $this->assertInstanceOf(User::class, $updatedUser);
        $this->assertEquals($user['name'], $updatedUser->name);
        $this->assertEquals($user['email'], $updatedUser->email);
    }

    public function test_update_user_exception()
    {
        $user = User::factory()->create()->toArray();
        unset($user['id']);
        $updateUserAction = new UpdateUser();

        $this->expectException(\Exception::class);

        $updateUserAction->handler(...$user);
    }

    public function test_delete_user_successfully()
    {
        $user = User::factory()->create()->toArray();

        $deleteUserAction = new DeleteUser();
        $deleteUserAction->handler(...$user);

        $this->assertFalse(User::where('id', $user['id'])->exists());
    }

    public function test_delete_user_exception()
    {
        $user = User::factory()->create()->toArray();
        unset($user['id']);

        $deleteUserAction = new DeleteUser();

        $this->expectException(\Exception::class);
        $deleteUserAction->handler(...$user);
    }
}
