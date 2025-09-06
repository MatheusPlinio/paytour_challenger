<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'phone',
        'desired_position',
        'education_level',
        'observations',
        'resume_path',
        'ip_address',
        'submitted_at',
    ];

    protected $casts = [
        'submitted_at' => 'datetime',
    ];
}
