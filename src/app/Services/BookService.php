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

    public function listBooks(array $filter): Builder
    {
        $this->setFilters($filter);

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

    private function setFilters(array $filter): void
    {
        if (!empty($filter['title'])) {
            $this->builderBook->where('title', 'LIKE', '%' . $filter['title'] . '%');
        }

        if (!empty($filter['description'])) {
            $this->builderBook->where('description', 'LIKE', '%' . $filter['description'] . '%');
        }

        if (!empty($filter['author'])) {
            $this->builderBook->where('author', 'LIKE', '%' . $filter['author'] . '%');
        }

        if (!empty($filter['pages'])) {
            $this->builderBook->where('pages', '=', $filter['pages']);
        }

        if (!empty($filter['heap_id'])) {
            $this->builderBook->whereHas('head', function (Builder $builder) use ($filter): void {
                $builder->whereIn('heap_id', $filter['heap_id']);
            });
        }
    }
}
