<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('indicator_results', function (Blueprint $table) {
            $table->id();

            $table->foreignId('project_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('indicator_id')
                ->constrained()
                ->cascadeOnDelete();

            // e.g. 2025-Q1, 2025-03, etc (you can store human label + date)
            $table->date('period_date');
            $table->string('period_label', 50)->nullable();

            // Numeric value (for number / percent)
            $table->decimal('value', 15, 2)->nullable();

            // Optional free-text (for qualitative notes or when data_type = text)
            $table->text('value_text')->nullable();

            $table->text('comment')->nullable();

            $table->foreignId('created_by')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('indicator_results');
    }
};
