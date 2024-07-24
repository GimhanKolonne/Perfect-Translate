<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('translators', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->integer('years_of_experience');
            $table->decimal('rate_per_word', 8, 2);
            $table->decimal('rate_per_hour', 8, 2);
            $table->string('availability');
            $table->text('bio');
            $table->text('type_of_translator');
            $table->text('language_pairs');
            $table->string('certificate_path')->nullable();
            $table->enum('verification_status', ['Not Verified', 'Pending', 'Verified'])->default('Not Verified');
            $table->enum('status', ['Active', 'Inactive'])->default('Active');
            $table->string('slug')->unique();
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('translators');
    }
};
