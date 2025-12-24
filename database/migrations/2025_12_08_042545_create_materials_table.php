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
        Schema::create('materials', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type'); // wood, metal, fabric, leather, etc.
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->decimal('price_per_unit', 10, 2)->nullable();
            $table->string('unit')->nullable(); // sq ft, meter, piece, etc.
            $table->json('properties')->nullable(); // durability, color, finish, etc.
            $table->boolean('is_available')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materials');
    }
};
