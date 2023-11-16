<?php

namespace App\Http\Controllers\Book;

use App\Http\Controllers\Controller;
use App\Services\BookService;
use Illuminate\Http\JsonResponse;

final class BookFindController extends Controller
{
    public function __construct(
        private readonly BookService $bookService,
    ) {
    }

    public function __invoke(int $id): JsonResponse
    {
        $book = $this->bookService->findBook($id);

        return response()->json([
            'success' => true,
            'data' => $book
        ]);
    }
}
