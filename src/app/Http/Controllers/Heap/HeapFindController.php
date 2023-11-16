<?php

namespace App\Http\Controllers\Heap;

use App\Http\Controllers\Controller;
use App\Services\HeapService;
use Illuminate\Http\JsonResponse;

final class HeapFindController extends Controller
{
    public function __construct(
        private readonly HeapService $heapService,
    ) {
    }

    public function __invoke(int $id): JsonResponse
    {
        $heap = $this->heapService->findHeap($id);

        return response()->json([
            'success' => true,
            'data' => $heap,
        ]);
    }
}
