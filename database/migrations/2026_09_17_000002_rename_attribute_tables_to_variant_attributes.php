<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::rename('attribute_types', 'variant_attributes');
        Schema::rename('attribute_values', 'variant_attribute_values');

        // MySQL RENAME COLUMN (8.0+) — keeps the existing FK to
        // variant_attributes.id intact, just tracking the new column name.
        DB::statement('ALTER TABLE variant_attribute_values RENAME COLUMN attribute_type_id TO attribute_id');
    }

    public function down(): void
    {
        DB::statement('ALTER TABLE variant_attribute_values RENAME COLUMN attribute_id TO attribute_type_id');
        Schema::rename('variant_attribute_values', 'attribute_values');
        Schema::rename('variant_attributes', 'attribute_types');
    }
};
