<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * The checkout page's "Packaging Options" picker (10/20/50 units per pack)
     * was purely a client-side display toggle with nothing to save it to.
     */
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->unsignedInteger('packaging_unit')->nullable()->after('gross_amount');
            $table->unsignedInteger('total_packs')->nullable()->after('packaging_unit');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['packaging_unit', 'total_packs']);
        });
    }
};
