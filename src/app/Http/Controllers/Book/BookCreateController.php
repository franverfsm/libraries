<?php

namespace App\Http\Controllers\Book;

use App\Http\Controllers\Controller;
use App\Http\Requests\Book\CreateBookRequest;
use App\Services\BookService;
use Illuminate\Http\JsonResponse;

final class BookCreateController extends Controller
{
    public function __construct(
        private readonly BookService $bookService,
    ) {
    }

    public function __invoke(CreateBookRequest $request): JsonResponse
    {
        $this->bookService->createBook($request->toArray());

        return response()->json();
    }
}
