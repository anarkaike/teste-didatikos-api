<?php

namespace App\Http\Responses;

use Exception;
use Illuminate\{
    Contracts\Support\Responsable,
    Http\Request,
    Http\JsonResponse,
};


/**
 * Classe para padronizar a raiz dos retornos falhos da API
 */
class ApiErrorResponse implements Responsable
{
    /**
     * @param Exception|null $exception
     * @param string|null $message
     * @param mixed $data
     */
    public function __construct(
        private ?Exception $exception = null,
        private ?string $message = null,
        private array $data = [],
        private int $code = 400
    ) {}

    /**
     * @param  $request
     * @return JsonResponse
     */
    public function toResponse($request = null)
    {
        $message = $this->message ?? $this->exception->getMessage();
        if(($messageArr = json_decode($message)) === false) $message = $messageArr;

        return response()->json(
            data: [
                'success' => false,
                'message' => $message,
                'code' => $this->exception && method_exists($this->exception, 'getMessageCode') ? $this->exception->getMessageCode() : null,
                'data' => $this->data,
                'exception' => $this->exception ? $this->exception->getTrace() : ''
            ],
            status: $this->code,
            headers: ['Content-Type' => 'application/json']
        );
    }
}
