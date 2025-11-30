<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('indicators', function (Blueprint $table) {
            // Some of these might already exist only if you manually created them.
            // In most cases they don't, so this will just add them.

            if (!Schema::hasColumn('indicators', 'data_type')) {
                $table->string('data_type', 20)->default('number')->after('unit');
            }

            if (!Schema::hasColumn('indicators', 'frequency')) {
                $table->string('frequency', 20)->nullable()->after('data_type');
            }

            if (!Schema::hasColumn('indicators', 'baseline_value')) {
                $table->decimal('baseline_value', 15, 2)->nullable()->after('frequency');
            }

            if (!Schema::hasColumn('indicators', 'target_value')) {
                $table->decimal('target_value', 15, 2)->nullable()->after('baseline_value');
            }

            if (!Schema::hasColumn('indicators', 'is_kpi')) {
                $table->boolean('is_kpi')->default(true)->after('target_value');
            }

            if (!Schema::hasColumn('indicators', 'is_active')) {
                $table->boolean('is_active')->default(true)->after('is_kpi');
            }
        });
    }

    public function down(): void
    {
        Schema::table('indicators', function (Blueprint $table) {
            if (Schema::hasColumn('indicators', 'is_active')) {
                $table->dropColumn('is_active');
            }
            if (Schema::hasColumn('indicators', 'is_kpi')) {
                $table->dropColumn('is_kpi');
            }
            if (Schema::hasColumn('indicators', 'target_value')) {
                $table->dropColumn('target_value');
            }
            if (Schema::hasColumn('indicators', 'baseline_value')) {
                $table->dropColumn('baseline_value');
            }
            if (Schema::hasColumn('indicators', 'frequency')) {
                $table->dropColumn('frequency');
            }
            if (Schema::hasColumn('indicators', 'data_type')) {
                $table->dropColumn('data_type');
            }
        });
    }
};
