<?php

namespace App\Http\Responses;

use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Illuminate\{
    Contracts\Support\Responsable,
    Http\JsonResponse,
};

/**
 * Classe para padronizar a raiz dos retornos exitosos da API
 */
class ApiSuccessResponse implements Responsable
{
    /**
     * @param mixed $data
     * @param string $message
     * @param array $metadata
     * @param int $code
     * @param array $headers
     */
    public function __construct(
        private mixed $data = [],
        private string $message = 'End point executado com sucesso!',
        private array $metadata = [],
        private int $code = ResponseAlias::HTTP_OK,
        private array $headers = ['Content-Type' => 'application/json']
    ) {}

    /**
     * @param  $request
     * @return JsonResponse
     */
    public function toResponse($request = null)
    {
        return response()->json(
            data: [
                'success' => true,
                'message' => $this->message,
                'data' => $this->data,
                'metadata' => $this->metadata,
            ],
            status: $this->code ?? 200,
            headers: $this->headers
        );
    }
}
