<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = ['user_name', 'message', 'project_id', 'project_file_id'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function projectFile()
    {
        return $this->belongsTo(ProjectFile::class);
    }
}
