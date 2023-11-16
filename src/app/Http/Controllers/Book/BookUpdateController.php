<?php

namespace App\Http\Controllers\Book;

use App\Http\Controllers\Controller;
use App\Http\Requests\Book\UpdateBookRequest;
use App\Services\BookService;
use Illuminate\Http\JsonResponse;

final class BookUpdateController extends Controller
{
    public function __construct(
        private readonly BookService $bookService,
    ) {
    }

    public function __invoke(int $id, UpdateBookRequest $request): JsonResponse
    {
        $this->bookService->updateBook($id, $request->toArray());

        return response()->json();
    }
}
