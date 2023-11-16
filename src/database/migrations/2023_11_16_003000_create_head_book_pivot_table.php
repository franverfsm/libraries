<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('heap_book', function (Blueprint $table): void {
            $table->id();
            $table->unsignedBigInteger('heap_id');
            $table->foreign('heap_id')
                ->references('id')
                ->on('heaps')
                ->onDelete('cascade');

            $table->unsignedBigInteger('book_id');
            $table->foreign('book_id')
                ->references('id')
                ->on('books')
                ->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('heap_book');
    }
};
