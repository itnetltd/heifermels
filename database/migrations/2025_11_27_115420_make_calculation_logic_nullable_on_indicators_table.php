<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Only change it if it exists
        if (Schema::hasColumn('indicators', 'calculation_logic')) {
            // Assuming it was a TEXT column – make it nullable
            DB::statement('ALTER TABLE indicators MODIFY calculation_logic TEXT NULL');
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('indicators', 'calculation_logic')) {
            // Revert to NOT NULL if you ever roll back
            DB::statement('ALTER TABLE indicators MODIFY calculation_logic TEXT NOT NULL');
        }
    }
};
