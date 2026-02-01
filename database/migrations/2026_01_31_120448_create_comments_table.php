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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->text('content');
            $table->integer('approvedByOwner')->default(0);
            $table->foreignId('parentCommentId')->nullable()->constrained('comments','id')->cascadeOnDelete();
            $table->foreignId('userId')->nullable()->constrained('users','id')->cascadeOnDelete();
            $table->foreignId('postId')->nullable()->constrained('posts','id')->cascadeOnDelete();
            $table->dateTime('createdAt');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
