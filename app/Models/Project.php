<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

/**
 * App\Models\Projects
 *
 * @property string $project_name
 * @property string $project_description
 * @property string $original_language
 * @property string $target_language
 * @property string $project_domain
 * @property string $project_start_date
 * @property string $project_end_date
 * @property string $project_budget
 * @property string $project_status
 * @property string $slug
 * @property string $user_id
 */
class Project extends Model
{
    use HasFactory;
    use Notifiable;

    protected $fillable = [
        'project_name',
        'project_description',
        'original_language',
        'target_language',
        'project_domain',
        'project_start_date',
        'project_end_date',
        'project_budget',
        'project_status',
        'editing_proofreading_allowed',
        'bidding_allowed',
        'user_id',
        'slug',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function translator()
    {
        return $this->belongsTo(User::class, 'translator_id');
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'reviewee_id', 'user_id');
    }

    public function sprints()
    {
        return $this->hasMany(Sprint::class);
    }
    public function chatMessages()
    {
        return $this->hasMany(ChatMessage::class);
    }
}
