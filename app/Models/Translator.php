<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

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
    use Notifiable;

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
        'verification_status',

    ];

    protected $casts = [
        'type_of_translator' => 'array',
        'language_pairs' => 'array',

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
    }

    public function portfolios()
    {
        return $this->hasMany(Portfolio::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'reviewee_id', 'user_id');
    }
}
