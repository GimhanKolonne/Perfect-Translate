<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\Portfolio
 * @property int $id
 * @property int $translator_id
 * @property string $title
 * @property string $role_description
 * @property string $overview
 * @property string $relevant_skills
 * @property string $tags
 * @property array $media
 * @property string $detailed_description
 * @property string $status
 */

class Portfolio extends Model
{
    use HasFactory;

    protected $fillable = [
        'translator_id',
        'title',
        'role_description',
        'overview',
        'relevant_skills',
        'tags',
        'media',
        'detailed_description',
        'status',
    ];

    protected $casts = [
        'media' => 'array',
    ];

    public function translator()
    {
        return $this->belongsTo(Translator::class);
    }
}
