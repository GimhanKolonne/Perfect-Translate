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
        Schema::create('portfolios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('translator_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->text('role_description');
            $table->text('overview');
            $table->text('relevant_skills')->nullable();
            $table->text('tags')->nullable();
            $table->json('media')->nullable();
            $table->text('detailed_description');
            $table->enum('status', ['Draft', 'Published'])->default('Draft');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('portfolios');
    }
};
