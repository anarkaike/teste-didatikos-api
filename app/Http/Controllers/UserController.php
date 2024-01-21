<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Actions\Users\{
    DeleteUser,
    StoreUser,
    UpdateUser,
};
use App\Http\{
    Requests\StoreUserRequest,
    Requests\UpdateUserRequest,
    Responses\ApiErrorResponse,
    Responses\ApiSuccessResponse,
};


class UserController extends Controller
{
    /**
     * Listagem de produtos
     */
    public function index()
    {
        try {
            $users = User::all();

            return new ApiSuccessResponse(
                data: $users->toArray(),
                message: trans(key: 'messages.users.listing_successfully')
            );
        } catch (\Exception $e) {
            return new ApiErrorResponse(exception: $e);
        }
    }

    /**
     * Insere um produto
     */
    public function store(StoreUserRequest $request)
    {
        try {
            $user = StoreUser::run(...$request->validationData());

            return new ApiSuccessResponse(
                data: $user->toArray(),
                message: trans(key: 'messages.users.creating_successfully')
            );
        } catch (\Exception $e) {
            return new ApiErrorResponse(exception: $e);
        }
    }

    /**
     * Obtem um produto
     */
    public function show(User $user)
    {
        try {
            return new ApiSuccessResponse(
                data: $user->toArray(),
                message: trans(key: 'messages.users.getting_successfully')
            );
        } catch (\Exception $e) {
            return new ApiErrorResponse(exception: $e);
        }
    }

    /**
     * Atualiza um produto
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        try {
            $userData = $request->validationData();
            if (!isset($userData['id'])) $userData['id'] = $user->id;
            $user = UpdateUser::run(...$userData);

            return new ApiSuccessResponse(
                data: $user->toArray(),
                message: trans(key: 'messages.users.updating_successfully')
            );
        } catch (\Exception $e) {
            return new ApiErrorResponse(exception: $e);
        }
    }

    /**
     * Remove um produto
     */
    public function destroy(User $user)
    {
        try {
            DeleteUser::run(...$user->toArray());

            return new ApiSuccessResponse(message: trans(key: 'messages.users.deleting_successfully'));
        } catch (\Exception $e) {
            return new ApiErrorResponse(exception: $e);
        }
    }
}
