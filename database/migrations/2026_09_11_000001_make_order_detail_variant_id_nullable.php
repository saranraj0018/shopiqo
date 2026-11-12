<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * "single" products have no ProductVariant row at all, so checkout can't
     * always supply a variant_id here — it was NOT NULL with no fallback value.
     */
    public function up(): void
    {
        DB::statement('ALTER TABLE order_details MODIFY variant_id BIGINT UNSIGNED NULL');
    }

    public function down(): void
    {
        DB::statement('ALTER TABLE order_details MODIFY variant_id BIGINT UNSIGNED NOT NULL');
    }
};
