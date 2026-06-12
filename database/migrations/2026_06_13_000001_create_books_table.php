<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('subtitle')->nullable();
            $table->string('category')->nullable();
            $table->string('year', 4)->nullable();
            $table->text('description')->nullable();
            $table->text('excerpt')->nullable();
            $table->string('cover')->nullable();
            $table->string('file_path')->nullable();
            $table->string('file_type', 10)->default('pdf');
            $table->decimal('price', 8, 2)->default(9.99);
            $table->boolean('featured')->default(false);
            $table->boolean('status')->default(true);
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
