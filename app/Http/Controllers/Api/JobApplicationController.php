<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreJobApplicationRequest;
use App\Models\JobApplication;
use Symfony\Component\HttpFoundation\Response;

class JobApplicationController extends Controller
{
    public function store(StoreJobApplicationRequest $request)
    {
        $data = $request->validated();

        $path = $request->file('resume_file')->store('resumes', 'public');

        $job_application = JobApplication::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'desired_position' => $data['desired_position'],
            'education_level' => $data['education_level'],
            'observations' => $data['observations'] ?? null,
            'resume_path' => $path,
            'ip_address' => $request->ip(),
            'submitted_at' => now(),
        ]);

        if (!$job_application) {
            return response()->json(["message" => "Erro ao enviar curriculo"], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()->json(["message" => "Curiculo enviado com sucesso"], Response::HTTP_CREATED);
    }
}
