<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * The customer-facing "Sample Process"/"Sample Review" screens showed a
     * hardcoded timeline with no backing state at all. Sample production
     * stages are admin-driven, same as order status, so they live on the
     * order plus a log table for the dated history the timeline needs.
     */
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->unsignedTinyInteger('sample_stage')->nullable()->after('sample_type');
            $table->timestamp('sample_approved_at')->nullable()->after('sample_stage');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['sample_stage', 'sample_approved_at']);
        });
    }
};
