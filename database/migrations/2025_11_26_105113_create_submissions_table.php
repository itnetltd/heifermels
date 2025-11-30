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
    Schema::create('submissions', function (Blueprint $table) {
        $table->id();
        $table->foreignId('form_id')->constrained()->onDelete('cascade');
        $table->foreignId('project_id')->nullable()->constrained()->onDelete('set null');
        $table->foreignId('participant_id')->nullable()->constrained()->onDelete('set null');
        $table->foreignId('submitted_by_user_id')->nullable()->constrained('users')->onDelete('set null');

        $table->string('external_source')->nullable(); // SurveyCTO, mobile_app, web
        $table->string('status')->default('submitted'); // draft, submitted, reviewed, approved, rejected

        $table->timestamp('submitted_at')->nullable();
        $table->timestamp('reviewed_at')->nullable();
        $table->timestamp('approved_at')->nullable();

        $table->json('data'); // actual filled form in JSON

        $table->json('metadata')->nullable(); // device, gps, etc.

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('submissions');
    }
};
