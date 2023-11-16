<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
