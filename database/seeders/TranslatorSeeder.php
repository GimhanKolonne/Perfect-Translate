<?php

namespace Database\Seeders;

use App\Models\Translator;
use Illuminate\Database\Seeder;

class TranslatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Translator::factory(10)->create();
    }
}
