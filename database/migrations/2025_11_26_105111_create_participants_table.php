<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('participants', function (Blueprint $table) {
            $table->id();

            // Link to project
            $table->foreignId('project_id')
                ->constrained('projects')          // explicit table name
                ->onDelete('cascade');

            // Unique Heifer participant ID
            $table->string('participant_uid')->unique();

            // Basic participant info
            $table->string('full_name')->nullable();
            $table->string('gender', 10)->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('phone')->nullable();
            $table->string('national_id')->nullable();

            // Location
            $table->string('province')->nullable();
            $table->string('district')->nullable();
            $table->string('sector')->nullable();
            $table->string('cell')->nullable();
            $table->string('village')->nullable();

            // Vulnerability / disaggregation
            $table->boolean('is_youth')->default(false);
            $table->boolean('is_person_with_disability')->default(false);

            // Flexible extra attributes (JSON: e.g. value chain, farmer group, etc.)
            $table->json('additional_attributes')->nullable();

            $table->timestamps();

            // Optional: quick filtering by project + district
            $table->index(['project_id', 'district']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('participants');
    }
};
