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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // ID Penulis
            $table->foreignId('category_id')->constrained()->onDelete('cascade'); // ID Kategori
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('image')->nullable(); // Foto thumbnail
            $table->text('content'); // Isi berita
            $table->enum('status', ['draft', 'pending', 'published'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
