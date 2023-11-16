<?php

namespace App\Http\Controllers\Heap;

use App\Http\Controllers\Controller;
use App\Http\Requests\Heap\UpdateHeapRequest;
use App\Services\HeapService;
use Illuminate\Http\JsonResponse;

final class HeapUpdateController extends Controller
{
    public function __construct(
        private readonly HeapService $heapService,
    ) {
    }

    public function __invoke(int $id, UpdateHeapRequest $request): JsonResponse
    {
        $this->heapService->updateHeap($id, $request->toArray());

        return response()->json();
    }
}
