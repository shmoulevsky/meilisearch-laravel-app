<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('books_genre', function (Blueprint $table) {
            $table->id();
            $table->foreignId('book_id')
                ->comment('Book')
                ->nullable()
                ->constrained('books')->nullOnDelete();

            $table->foreignId('genre_id')
                ->comment('Genre')
                ->nullable()
                ->constrained('genres')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books_genres');
    }
};
