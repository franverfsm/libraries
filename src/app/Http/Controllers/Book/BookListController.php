<?php

namespace App\Http\Controllers\Book;

use App\Http\Controllers\Controller;
use App\Services\BookService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class BookListController extends Controller
{
    public function __construct(
        private readonly BookService $bookService,
    ) {
    }

    public function __invoke(Request $request): JsonResponse
    {
        $books = $this->bookService->listBooks();

        return response()->json([
            'success' => true,
            'data' => $books->paginate(),
        ]);
    }
}
