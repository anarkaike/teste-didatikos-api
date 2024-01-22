<?php

namespace App\Exceptions;

use App\Http\Responses\ApiErrorResponse;
use App\Models\Brand;
use App\Models\City;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->renderable(function (NotFoundHttpException $e, $request) {
            if ($request->is('api/*')) {
                $message = 'Registro não encntrado';
                if ($e->getPrevious() instanceof ModelNotFoundException) {
                    /** @var ModelNotFoundException $modelNotFound */
                    $modelNotFound = $e->getPrevious();
                    switch ($modelNotFound->getModel()) {
                        case Product::class:
                            $message = trans(key: 'messages.products.not_found');
                            break;
                        case Brand::class:
                            $message = trans(key: 'messages.brands.not_found');
                            break;
                        case City::class:
                            $message = trans(key: 'messages.cities.not_found');
                            break;
                        case User::class:
                            $message = trans(key: 'messages.users.not_found');
                            break;
                    }
                }
                return new ApiErrorResponse(message: $message);
            }
        });
    }
}
