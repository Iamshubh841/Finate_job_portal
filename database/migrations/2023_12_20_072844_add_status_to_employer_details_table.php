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
            Schema::table('employer_details', function (Blueprint $table) {
                $table->boolean('status')->default(1)->after('website');
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('employer_details', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
