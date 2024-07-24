<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Translator
 *
 * @property string $type_of_translator
 * @property string $language_pairs
 * @property string $years_of_experience
 * @property string $rate_per_word
 * @property string $rate_per_hour
 * @property string $availability
 * @property string $bio
 * @property string $slug
 * @property string $status
 * @property string $user_id
 */
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
        'slug',
        'status',
        'user_id',

    ];
    protected $casts = [
        'type_of_translator' => 'array',
        'language_pairs' => 'array',

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function certificates()
    {
        return $this->hasMany(Certificate::class);
    }
}

