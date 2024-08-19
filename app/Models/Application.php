<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Application
 * @property int $id
 * @property int $project_id
 * @property int $user_id
 * @property string $application_message
 * @property string $cv
 * @property string $contact_email
 * @property string $contact_phone
 * @property string $language_proficiency
 * @property string $status
 * @property string $slug
 */

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'user_id',
        'application_message',
        'cv',
        'contact_email',
        'contact_phone',
        'language_proficiency',
        'status',
        'slug',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function translator()
    {
        return $this->belongsTo(Translator::class, 'user_id', 'user_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'reviewee_id', 'user_id');
    }
}
