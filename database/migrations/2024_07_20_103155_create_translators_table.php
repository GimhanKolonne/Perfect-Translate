<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('translators', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained()->onDelete('cascade');
            $table->string('type_of_translator')->nullable();
            $table->string('language_pairs')->nullable();
            $table->integer('years_of_experience')->nullable();
            $table->decimal('rate_per_word', 8, 2)->nullable();
            $table->decimal('rate_per_hour', 8, 2)->nullable();
            $table->string('availability')->nullable();
            $table->text('bio')->nullable();
            $table->boolean('is_verified')->default(false);
            $table->string('slug')->unique();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('translators');
    }
};
