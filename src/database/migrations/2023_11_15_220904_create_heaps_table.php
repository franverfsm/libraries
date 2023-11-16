<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration
{
    public function up(): void
    {
        Schema::create('heaps', function (Blueprint $table): void {
            $table->id();
            $table->string('name', 128);
            $table->integer('cep')->nullable();
            $table->string('address')->nullable();
            $table->integer('number')->nullable();
            $table->string('bourg', 128)->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('heaps');
    }
};
