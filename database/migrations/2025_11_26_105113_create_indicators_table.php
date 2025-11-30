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
    Schema::create('indicators', function (Blueprint $table) {
        $table->id();

        $table->foreignId('project_id')
            ->constrained()
            ->onDelete('cascade');

        $table->string('code', 50);          // e.g. RDDP-II_KPI1
        $table->string('name');              // Indicator name
        $table->text('description')->nullable();

        $table->string('unit', 50)->nullable();       // e.g. HHs, %, litres, RWF
        $table->string('data_type', 20)->default('number'); // number, percent, text, yes_no
        $table->string('frequency', 20)->nullable();  // annual, quarterly, monthly, ad-hoc

        $table->decimal('baseline_value', 15, 2)->nullable();
        $table->decimal('target_value', 15, 2)->nullable();

        $table->boolean('is_kpi')->default(true);
        $table->boolean('is_active')->default(true);

        $table->timestamps();

        $table->unique(['project_id', 'code']); // code unique within a project
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('indicators');
    }
};
