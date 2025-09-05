<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreJobApplicationRequest;
use App\Http\Resources\JobApplicationsResource;
use App\Mail\JobApplicationReceived;
use App\Models\JobApplication;
use App\Repositories\Contracts\JobApplicationRepositoryInterface;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class JobApplicationController extends Controller
{
    public function __construct(protected JobApplicationRepositoryInterface $repository)
    {
    }

    public function index(Request $request)
    {
        $perPage = $request->query('per_page', 10);

        $applications = JobApplication::orderBy('submitted_at', 'desc')->paginate($perPage);

        return JobApplicationsResource::collection($applications)
            ->additional([
                'meta' => [
                    'current_page' => $applications->currentPage(),
                    'last_page' => $applications->lastPage(),
                    'per_page' => $applications->perPage(),
                    'total' => $applications->total(),
                ]
            ]);
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

    public function show(JobApplication $job_application)
    {
        return JobApplicationsResource::collection(
            $job_application
        );
    }

    public function delete(JobApplication $job_application)
    {
        $delete = $job_application->delete();

        if (!$delete) {
            return response()->json(["message" => "Erro ao deletar curriculo"], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()->json(["message" => "Curiculo deletado com sucesso"], Response::HTTP_OK);
    }
}
