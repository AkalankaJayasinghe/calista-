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
        Schema::create('consultations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('designer_id')->constrained()->onDelete('cascade');
            $table->string('project_type'); // residential, commercial, renovation, etc.
            $table->text('project_description');
            $table->json('space_details')->nullable(); // dimensions, current state, etc.
            $table->decimal('budget', 10, 2)->nullable();
            $table->date('preferred_date');
            $table->time('preferred_time');
            $table->enum('consultation_type', ['in-person', 'virtual', 'phone'])->default('in-person');
            $table->text('consultation_address')->nullable();
            $table->json('reference_images')->nullable();
            $table->text('additional_notes')->nullable();
            $table->enum('status', ['pending', 'confirmed', 'completed', 'cancelled', 'rescheduled'])->default('pending');
            $table->date('scheduled_date')->nullable();
            $table->time('scheduled_time')->nullable();
            $table->decimal('fee_amount', 10, 2)->default(0);
            $table->enum('payment_status', ['pending', 'paid'])->default('pending');
            $table->text('designer_notes')->nullable();
            $table->text('cancellation_reason')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consultations');
    }
};
