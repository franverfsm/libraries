<?php

namespace App\Http\Controllers\Book;

use App\Http\Controllers\Controller;
use App\Services\BookService;
use Illuminate\Http\JsonResponse;

final class BookDeleteController extends Controller
{
    public function __construct(
        private readonly BookService $bookService,
    ) {
    }

    public function __invoke(int $id): JsonResponse
    {
        $this->bookService->deleteBook($id);

        return response()->json([
            'success' => true,
            'message' => 'Deleted book',
        ], 204);
    }
}
