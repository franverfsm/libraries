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
        return $this->builderHeap->create($dataBook);
    }

    public function updateHeap(int $id, array $dataBook)
    {
        $heap = $this->builderHeap->findOrFail($id);

        $heap->update($dataBook);

        return $heap;
    }

    public function deleteHeap(int $id)
    {
        $heap = $this->builderHeap->find($id);

        return $heap->delete();
    }
}
