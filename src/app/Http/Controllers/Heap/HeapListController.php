<?php

namespace App\Http\Controllers\Heap;

use App\Http\Controllers\Controller;
use App\Services\HeapService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class HeapListController extends Controller
{
    public function __construct(
        private readonly HeapService $heapService,
    ) {
    }

    public function __invoke(Request $request): JsonResponse
    {
        $heaps = $this->heapService->listHeaps();

        return response()->json([
            'success' => true,
            'data' => $heaps->paginate(),
        ]);
    }
}
