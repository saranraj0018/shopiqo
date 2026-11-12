<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->unsignedSmallInteger('sample_days')->nullable()->after('production_max_days');
            // Comma-separated pack sizes this product ships in, e.g. "10,20,50".
            // Null falls back to a default set in the UI.
            $table->string('packaging_units')->nullable()->after('sample_days');
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['sample_days', 'packaging_units']);
        });
    }
};
