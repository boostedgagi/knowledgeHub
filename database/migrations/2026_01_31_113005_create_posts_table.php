<?php

use Carbon\Carbon;
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
            $table->text('postContent');
            $table->integer('upVotes')->default(0);
            $table->integer('downVotes')->default(0);
            $table->foreignId('categoryId')->nullable()->constrained('categories','id')->nullOnDelete();
            $table->foreignId('userId')->constrained('users','id')->cascadeOnDelete();
            $table->dateTime('createdAt')->default(Carbon::now()->format('Y-m-d H:i:s'));
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
