<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\JobApplication;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Mail;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class JobApplicationControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_list_job_applications_with_auth()
    {
        $user = User::factory()->create();
        JobApplication::factory()->count(3)->create();

        Sanctum::actingAs($user);

        $response = $this->getJson(route('job_applications.index'));

        $response->assertOk()->assertJsonStructure(['data', 'meta']);
    }

    /** @test */
    public function it_cannot_list_job_applications_without_auth()
    {
        $response = $this->getJson(route('job_applications.index'));

        $response->assertUnauthorized();
    }

    /** @test */
    public function it_can_store_a_job_application()
    {
        Mail::fake();

        $payload = [
            'name' => 'Candidate',
            'email' => 'candidate@example.com',
            'phone' => '123456789',
            'desired_position' => 'Developer',
            'education_level' => 'superior_incompleto',
            'resume_path' => UploadedFile::fake()->create('resume.pdf', 100), // <-- arquivo fake
        ];

        $response = $this->postJson(route('job_applications.store'), $payload);

        $response->assertCreated()
            ->assertJson(['message' => 'Curiculo enviado com sucesso']);

        $this->assertDatabaseHas('job_applications', ['email' => 'candidate@example.com']);
    }

    /** @test */
    public function it_can_show_a_job_application()
    {
        $jobApplication = JobApplication::factory()->create();

        $response = $this->getJson(route('job_applications.show', $jobApplication));

        $response->assertOk();
    }

    /** @test */
    public function it_can_delete_a_job_application()
    {
        $jobApplication = JobApplication::factory()->create();

        $response = $this->deleteJson(route('job_applications.delete', $jobApplication));

        $response->assertOk()
            ->assertJson(['message' => 'Curiculo deletado com sucesso']);

        $this->assertDatabaseMissing('job_applications', ['id' => $jobApplication->id]);
    }
}
