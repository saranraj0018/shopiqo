<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Comma-separated print methods this product supports, e.g. "Laser,Screen Print".
            // Values are matched against the shop page's Print Capability filter.
            $table->string('print_capability')->nullable()->after('packaging_units');
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('print_capability');
        });
    }
};
