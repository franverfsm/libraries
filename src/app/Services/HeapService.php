<?php

namespace App\Services;

use App\Models\Heap;
use Illuminate\Database\Eloquent\Builder;

final class HeapService
{
    public function __construct(
        private Builder $builderHeap,
    ) {
        $this->builderHeap = Heap::query();
    }

    public function listHeaps(): Builder
    {
        return $this->builderHeap;
    }

    public function findHeap(int $id)
    {
        return $this->builderHeap->findOrFail($id);
    }

    public function createHeap(array $dataBook)
    {
        $heap = $this->builderHeap->create($dataBook);

        if (!empty($dataBook['heap_ids']) && $heap) {
            $heap->book()->sync($dataBook['heap_ids']);
        }
        return $this->builderHeap->create($dataBook);
    }

    public function updateHeap(int $id, array $dataBook)
    {
        $heap = $this->builderHeap->findOrFail($id);

        $heap->update($dataBook);

        if (isset($dataBook['book_ids'])) {
            $heap->book()->sync($dataBook['book_ids']);
        }

        return $heap;
    }

    public function deleteHeap(int $id)
    {
        $heap = $this->builderHeap->find($id);

        return $heap->delete();
    }
}
