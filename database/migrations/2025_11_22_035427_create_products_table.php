<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{
    Schema::create('products', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('slug')->unique();
        $table->decimal('average_rating', 3, 2)->default(0);
        $table->text('description')->nullable();
        $table->decimal('price', 10, 2);
        $table->string('image')->nullable();
        $table->unsignedBigInteger('category_id')->nullable();
        $table->integer('stock_quantity')->default(0);
        $table->boolean('is_active')->default(true);

        // අලුතින් මේක එකතු කරන්න (Soft Deletes සඳහා)
        $table->softDeletes();

        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
