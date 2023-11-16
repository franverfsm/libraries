<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

final class Book extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
       'title',
       'description',
       'author',
       'pages',
    ];

    protected $casts = [
        'pages' => 'integer',
    ];

    public function heap(): BelongsToMany
    {
        return $this->belongsToMany(Heap::class, 'heap_book', 'book_id', 'heap_id');
    }
}
