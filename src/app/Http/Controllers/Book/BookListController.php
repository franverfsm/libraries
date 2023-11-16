<?php

namespace App\Http\Controllers\Book;

use App\Http\Controllers\Controller;
use App\Http\Requests\Book\FilterBookRequest;
use App\Services\BookService;
use Illuminate\Http\JsonResponse;

final class BookListController extends Controller
{
    public function __construct(
        private readonly BookService $bookService,
    ) {
    }

    public function __invoke(FilterBookRequest $request): JsonResponse
    {
        $books = $this->bookService->listBooks($request->toArray());
        $perPage = $request->get('per_page', 15);
        $page = $request->get('page', 1);

        return response()->json([
            'success' => true,
            'data' => $books->paginate(perPage: $perPage, page: $page),
        ]);
    }
}
