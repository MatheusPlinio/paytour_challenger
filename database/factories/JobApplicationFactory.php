<?php

namespace Database\Factories;

use App\Models\JobApplication;
use Illuminate\Database\Eloquent\Factories\Factory;

class JobApplicationFactory extends Factory
{
    protected $model = JobApplication::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
            'desired_position' => $this->faker->jobTitle(),
            'education_level' => $this->faker->randomElement([
                'fundamental_incompleto',
                'fundamental_completo',
                'medio_incompleto',
                'medio_completo',
                'superior_incompleto',
                'superior_completo',
                'pos_graduacao',
                'mestrado',
                'doutorado',
            ]),
            'resume_path' => 'resumes/fake.pdf',
            'submitted_at' => now(),
            'ip_address' => $this->faker->ipv4(),
        ];
    }
}
