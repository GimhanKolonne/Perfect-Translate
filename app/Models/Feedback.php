<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $fillable = ['sprint_id', 'client_name', 'message'];

    public function sprint()
    {
        return $this->belongsTo(Sprint::class);
    }
}
