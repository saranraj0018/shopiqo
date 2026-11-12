<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Packaging is chosen per line item now (each product in the cart can
     * have its own pack size), not once for the whole order.
     */
    public function up(): void
    {
        Schema::table('order_details', function (Blueprint $table) {
            $table->unsignedInteger('packaging_unit')->nullable()->after('quantity');
            $table->unsignedInteger('total_packs')->nullable()->after('packaging_unit');
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['packaging_unit', 'total_packs']);
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->unsignedInteger('packaging_unit')->nullable()->after('gross_amount');
            $table->unsignedInteger('total_packs')->nullable()->after('packaging_unit');
        });

        Schema::table('order_details', function (Blueprint $table) {
            $table->dropColumn(['packaging_unit', 'total_packs']);
        });
    }
};
