<?php

namespace App\Repositories\Eloquent;

use App\Models\JobApplication;
use App\Repositories\Contracts\JobApplicationRepositoryInterface;

class JobApplicationRepository implements JobApplicationRepositoryInterface
{
    public function store($data, $path, $ip): JobApplication
    {
        return JobApplication::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'desired_position' => $data['desired_position'],
            'education_level' => $data['education_level'],
            'observations' => $data['observations'] ?? null,
            'resume_path' => $path,
            'ip_address' => $ip,
            'submitted_at' => now()
        ]);
    }
}