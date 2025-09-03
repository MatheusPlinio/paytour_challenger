<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('job_applications', function (Blueprint $table) {
            $table->id();
            $table->string('name', 150);
            $table->string('email', 150);
            $table->string('phone', 20);
            $table->string('desired_position', 150);
            $table->enum('education_level', [
                'fundamental_incompleto',
                'fundamental_completo',
                'medio_incompleto',
                'medio_completo',
                'superior_incompleto',
                'superior_completo',
                'pos_graduacao',
                'mestrado',
                'doutorado'
            ]);
            $table->text('observations')->nullable();
            $table->string('resume_path');
            $table->string('ip_address', 45);
            $table->timestamp('submitted_at')->useCurrent();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_applications');
    }
};
