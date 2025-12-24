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
        Schema::create('designs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('workshop_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('category'); // chair, table, cabinet, etc.
            $table->string('style'); // modern, traditional, rustic, etc.
            $table->json('dimensions')->nullable();
            $table->json('materials_used')->nullable();
            $table->json('images');
            $table->json('technical_drawings')->nullable();
            $table->decimal('estimated_price', 10, 2)->nullable();
            $table->integer('estimated_days')->nullable();
            $table->enum('visibility', ['public', 'private'])->default('public');
            $table->integer('views_count')->default(0);
            $table->integer('likes_count')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('designs');
    }
};
