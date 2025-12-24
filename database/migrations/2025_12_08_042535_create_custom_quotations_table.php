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
        Schema::create('custom_quotations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('custom_request_id')->constrained()->onDelete('cascade');
            $table->foreignId('workshop_id')->constrained()->onDelete('cascade');
            $table->decimal('quoted_price', 10, 2);
            $table->integer('estimated_days');
            $table->json('material_breakdown')->nullable();
            $table->json('labor_breakdown')->nullable();
            $table->text('work_description');
            $table->text('terms_conditions')->nullable();
            $table->date('valid_until');
            $table->enum('status', ['pending', 'accepted', 'rejected', 'expired'])->default('pending');
            $table->text('rejection_reason')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('custom_quotations');
    }
};
