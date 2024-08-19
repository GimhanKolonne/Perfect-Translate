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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->text('project_name');
            $table->text('project_description')->nullable();
            $table->text('original_language')->nullable();
            $table->text('target_language')->nullable();
            $table->text('project_domain')->nullable();
            $table->date('project_start_date')->nullable();
            $table->date('project_end_date')->nullable();
            $table->decimal('project_budget', 10, 2)->nullable();
            $table->enum('project_status', ['Pending', 'In Progress', 'Completed', 'Cancelled'])->default('Pending');
            $table->boolean('editing_proofreading_allowed')->default(false);
            $table->boolean('bidding_allowed')->default(false);
            $table->string('slug')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
