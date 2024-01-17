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
        Schema::table('employer_details', function (Blueprint $table) {
            if (!Schema::hasColumn('employer_details', 'job_id')) {
                $table->unsignedBigInteger('job_id');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('employer_details', function (Blueprint $table) {
            if (Schema::hasColumn('employer_details', 'job_id')) {
                $table->dropForeign(['job_id']);
            }
        });
    }
};
