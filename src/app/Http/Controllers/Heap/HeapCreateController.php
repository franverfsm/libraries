<?php

namespace App\Http\Controllers\Heap;

use App\Http\Controllers\Controller;
use App\Http\Requests\Heap\CreateHeapRequest;
use App\Services\HeapService;
use Illuminate\Http\JsonResponse;

final class HeapCreateController extends Controller
{
    public function __construct(
        private readonly HeapService $heapService,
    ) {
    }

    public function __invoke(CreateHeapRequest $request): JsonResponse
    {
        $this->heapService->createHeap($request->toArray());

        return response()->json([], 201);
    }
}
