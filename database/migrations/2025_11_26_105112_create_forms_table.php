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
    Schema::create('forms', function (Blueprint $table) {
        $table->id();
        $table->foreignId('project_id')->nullable()->constrained()->onDelete('set null');
        $table->string('code')->unique(); // e.g. HH_REG, MONTHLY_SAVINGS
        $table->string('name');
        $table->text('description')->nullable();
        $table->boolean('is_active')->default(true);
        $table->json('definition'); 
        // e.g., JSON schema: fields, types, constraints, skip logic
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('forms');
    }
};
