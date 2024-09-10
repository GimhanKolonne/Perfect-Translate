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
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->string('user_name');
            $table->text('message');
            $table->foreignId('project_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('project_file_id')->nullable();
            $table->timestamps();

            $table->foreign('project_file_id')->references('id')->on('project_files')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
