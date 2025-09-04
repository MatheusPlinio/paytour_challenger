<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreJobApplicationRequest;
use App\Mail\JobApplicationReceived;
use App\Models\JobApplication;
use App\Repositories\Contracts\JobApplicationRepositoryInterface;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpFoundation\Response;

class JobApplicationController extends Controller
{
    public function __construct(protected JobApplicationRepositoryInterface $repository)
    {
    }
    public function store(StoreJobApplicationRequest $request)
    {
        $data = $request->validated();

        $path = $request->file('resume_file')->store('resumes', 'public');

        $job_application = $this->repository->store($data, $path, $request->ip());

        if (!$job_application) {
            return response()->json(["message" => "Erro ao enviar curriculo"], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        Mail::to(config('mail.mailers.to.address'))->send(new JobApplicationReceived($job_application));

        return response()->json(["message" => "Curiculo enviado com sucesso"], Response::HTTP_CREATED);
    }
}
