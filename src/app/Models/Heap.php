<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

final class Heap extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'cep',
        'address',
        'number',
        'bourg',
        'city',
        'state',
    ];

    protected $casts = [
        'cep' => 'integer',
    ];

    public function book(): BelongsToMany
    {
        return $this->belongsToMany(Book::class, 'heap_book', 'heap_id', 'book_id');
    }
}
