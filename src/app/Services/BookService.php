<?php

namespace App\Services;

use App\Models\Book;
use Illuminate\Database\Eloquent\Builder;

final class BookService
{
    public function __construct(
        private Builder $builderBook,
    ) {
        $this->builderBook = Book::query();
    }
    public function listBooks(): Builder
    {
        return $this->builderBook;
    }

    public function findBook(int $id)
    {
        return $this->builderBook->findOrFail($id);
    }

    public function createBook(array $dataBook)
    {
        $book = $this->builderBook->create($dataBook);

        return $book;
    }

    public function updateBook(int $id, array $dataBook)
    {
        $book = $this->builderBook->findOrFail($id);

        $book->update($dataBook);

        return $book;
    }

    public function deleteBook(int $id)
    {
        $book = $this->builderBook->find($id);

        return $book->delete();
    }
}
