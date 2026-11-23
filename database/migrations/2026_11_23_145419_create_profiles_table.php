<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();

            // Personal information
            $table->string('full_name');
            $table->string('professional_title')->nullable();

            // Biography
            $table->string('short_bio', 500)->nullable();
            $table->longText('about')->nullable();

            // Contact information
            $table->string('email')->nullable();
            $table->string('phone', 30)->nullable();
            $table->string('location')->nullable();

            // Social media and website
            $table->string('github_url')->nullable();
            $table->string('linkedin_url')->nullable();
            $table->string('website_url')->nullable();

            // Uploaded files
            $table->string('profile_photo')->nullable();
            $table->string('resume_path')->nullable();

            // Availability
            $table->string('availability_status')
                ->default('Available for opportunities');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};