<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Translator extends Model
{
    use HasFactory;
    protected $fillable = [
        'type_of_translator',
        'language_pairs',
        'years_of_experience',
        'rate_per_word',
        'rate_per_hour',
        'availability',
        'bio',
        'is_verified',
        'slug',
        'status',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
