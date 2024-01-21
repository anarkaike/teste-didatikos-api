<?php

namespace App\Http\Controllers;

use App\Actions\Users\StoreUser;
use App\Models\User;
use Laravel\Sanctum\PersonalAccessToken;
use Illuminate\{
    Http\Request,
    Support\Facades\Auth
};
use App\Http\{
    Requests\StoreUserRequest,
    Responses\ApiErrorResponse,
    Responses\ApiSuccessResponse
};


class AuthController extends Controller
{
    public function login(Request $request)
    {
        try {
            if (!Auth::attempt($request->only('email', 'password'))) {
                throw new \Exception(message: trans(key: 'auth.failed'));
            }

            return new ApiSuccessResponse(
                data: [
                    'token' => $request->user()->createToken('invoice', []),
                    'user'  => $request->user()->toArray()
                ],
                message: trans(key: 'auth.login_successful')
            );
        } catch (\Exception $e) {
            return new ApiErrorResponse(exception: $e);
        }
    }

    public function logout(Request $request)
    {
        try {
            $accessToken    = $request->bearerToken();
            $token          = PersonalAccessToken::findToken($accessToken);

            if (!$token)            throw new \Exception(message: trans(key: 'auth.invalid_token'));
            if (!$token->delete())  throw new \Exception(message: trans(key: 'auth.error_deleting_token'));

            return new ApiSuccessResponse(message: trans(key: 'auth.logout_successful'));
        } catch (\Exception $e) {
            return new ApiErrorResponse(exception: $e);
        }
    }

    public function register(StoreUserRequest $request) {
        try {
            $user = StoreUser::run(...$request->validationData());

            return new ApiSuccessResponse(
                data: [
                    'token' => $user->createToken('invoice', []),
                    'user' => $user->toArray()
                ],
                message: trans(key: 'auth.registration_successful')
            );
        } catch (\Exception $e) {
            return new ApiErrorResponse(exception: $e);
        }
    }
}
