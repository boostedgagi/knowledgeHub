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
            $table->text('content');
            $table->integer('upVotes')->default(0);
            $table->integer('downVotes')->default(0);
            $table->foreignId('categoryId')->constrained()->nullOnDelete();
            $table->foreignId('userId')->constrained()->cascadeOnDelete();
            $table->dateTime('createdAt');
            $table->dateTime('updatedAt')->nullable();
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
