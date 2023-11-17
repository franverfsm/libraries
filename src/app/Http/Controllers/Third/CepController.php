<?php

namespace App\Http\Controllers\Third;

use App\Http\Controllers\Controller;
use App\Services\CepService;
use Exception;
use Illuminate\Http\JsonResponse;

final class CepController extends Controller
{
    public function __construct(
        private readonly CepService $cepService,
    ) {
    }

    /**
     * @throws Exception
     */
    public function __invoke(string $cepNumber): JsonResponse
    {
        return response()->json([
            'data' => $this->cepService->findByCep($cepNumber),
        ]);
    }
}
