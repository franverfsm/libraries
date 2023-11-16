<?php

namespace App\Http\Controllers\Heap;

use App\Http\Controllers\Controller;
use App\Services\HeapService;
use Illuminate\Http\JsonResponse;

final class HeapDeleteController extends Controller
{
    public function __construct(
        private readonly HeapService $heapService,
    ) {
    }

    public function __invoke(int $id): JsonResponse
    {
        $this->heapService->deleteHeap($id);

        return response()->json([
            'success' => true,
            'message' => 'Deleted heap',
        ], 204);
    }
}
