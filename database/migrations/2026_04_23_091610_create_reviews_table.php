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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->string('locale', 3)->nullable();
            $table->string('author');
            $table->string('avatar')->nullable();
            $table->string('location')->nullable();
            $table->text('content');
            $table->string('group', 50)->nullable();
            $table->unsignedTinyInteger('rating')->nullable(); // 1–5
            $table->integer('sort')->default(0);
            $table->boolean('active')->default(true);
            $table->timestamps();
            $table->index(['active', 'sort', 'group', 'locale']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
