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
        Schema::create('design_projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('designer_id')->constrained()->onDelete('cascade');
            $table->foreignId('consultation_id')->nullable()->constrained()->onDelete('set null');
            $table->string('project_name');
            $table->text('description');
            $table->string('project_type'); // residential, commercial, etc.
            $table->json('space_details')->nullable();
            $table->decimal('total_budget', 10, 2);
            $table->decimal('design_fee', 10, 2);
            $table->enum('status', ['planning', 'in_progress', 'review', 'completed', 'on_hold', 'cancelled'])->default('planning');
            $table->date('start_date');
            $table->date('expected_completion');
            $table->date('actual_completion')->nullable();
            $table->integer('progress_percentage')->default(0);
            $table->json('milestones')->nullable();
            $table->json('design_files')->nullable(); // 3D models, floor plans, etc.
            $table->json('before_images')->nullable();
            $table->json('after_images')->nullable();
            $table->text('client_feedback')->nullable();
            $table->integer('rating')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('design_projects');
    }
};
