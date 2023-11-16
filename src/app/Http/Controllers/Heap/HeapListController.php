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

        $perPage = $request->get('per_page', 15);
        $page = $request->get('page', 1);

        return response()->json([
            'success' => true,
            'data' => $heaps->paginate(perPage: $perPage, page: $page),
        ]);
    }
}
