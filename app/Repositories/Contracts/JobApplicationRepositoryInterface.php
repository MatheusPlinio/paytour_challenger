<?php

namespace App\Repositories\Contracts;

use App\Models\JobApplication;

interface JobApplicationRepositoryInterface
{
    /**
     * Create a new JobApplication
     * 
     * @param array{
     *     name: string,
     *     email: string,
     *     phone: string,
     *     desired_position: string,
     *     education_level: string,
     *     observations?: string|null,
     *     resume_path: \Illuminate\Http\UploadedFile
     * } $data
     * @return JobApplication
     */
    public function store(array $data, string $path, string $ip): JobApplication;
}