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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('company_name')->nullable();
            $table->string('contact_name');
            $table->string('contact_phone')->nullable();
            $table->text('company_address')->nullable();
            $table->string('country')->nullable();
            $table->text('website')->nullable();
            $table->string('industry')->nullable();
            $table->text('bio')->nullable();
            $table->string('document_path')->nullable();
            $table->enum('verification_status', ['Not Verified', 'Pending', 'Verified'])->default('Not Verified');
            $table->string('slug')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
