<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Client
 *
 * @property string $company_name
 * @property string $contact_name
 * @property string $contact_phone
 * @property string $company_address
 * @property string $country
 * @property string $website
 * @property string $industry
 * @property string $bio
 * @property string $slug
 * @property string $user_id
 * @property string $verification_status
 */
class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_name',
        'contact_name',
        'contact_phone',
        'company_address',
        'country',
        'website',
        'industry',
        'bio',
        'slug',
        'user_id',
        'verification_status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);

    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'reviewee_id', 'user_id');
    }
}
