<?php

namespace Database\Seeders;

use App\Http\Controllers\TranslatorController;
use App\Models\Translator;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TranslatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Translator::create([
            'user_id' => 1,
            'type_of_translator' => 'Medical Translator',
            'language_pairs' => 'English to Spanish',

            'years_of_experience' => 5,
            'rate_per_word' => 0.05,
            'rate_per_hour' => 20.00,
            'availability' => 'Full-time',
            'bio' => 'I am a professional translator with 5 years of experience.',
            'is_verified' => false,
            'slug' => 'medical-translator',
        ]);
    }
}
