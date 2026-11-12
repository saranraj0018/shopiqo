<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Dedicated bulk per-piece fallback price — previously borrowed
     * products.regular_price for this, which conflated "single product
     * price" and "bulk fallback price" in one ambiguous column.
     */
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->decimal('per_piece_price', 10, 2)->nullable()->after('sale_price');
        });

        // Backfill: bulk products already have their fallback sitting in
        // regular_price from the previous approach — carry it over so
        // existing bulk products keep working after this migration.
        DB::table('products')->where('product_type', 'bulk')->update([
            'per_piece_price' => DB::raw('regular_price'),
        ]);
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('per_piece_price');
        });
    }
};
