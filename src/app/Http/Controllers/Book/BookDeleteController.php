<?php

namespace App\Http\Controllers\Book;

use App\Http\Controllers\Controller;
use App\Services\BookService;
use Illuminate\Http\Response;

final class BookDeleteController extends Controller
{
    public function __construct(
        private readonly BookService $bookService,
    ) {
    }

    public function __invoke(int $id): Response
    {
        $this->bookService->deleteBook($id);

        return response()->noContent();
    }
}
