<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Move every existing "bulk tier" row (pri_attribute_id NULL) out of
        // product_variants/product_variant_values into the new dedicated tables.
        $bulkRows = DB::table('product_variants')->whereNull('pri_attribute_id')->get();

        foreach ($bulkRows as $row) {
            $bulkProductId = DB::table('bulk_products')->insertGetId([
                'product_id'    => $row->product_id,
                'minimum'       => $row->minimum,
                'maximum'       => $row->maximum,
                'regular_price' => $row->regular_price,
                'sale_price'    => $row->sale_price,
                'created_at'    => $row->created_at,
                'updated_at'    => $row->updated_at,
            ]);

            $values = DB::table('product_variant_values')->where('product_variant_id', $row->id)->get();
            foreach ($values as $value) {
                DB::table('bulk_product_variants')->insert([
                    'bulk_product_id'    => $bulkProductId,
                    'attribute_id'       => $value->attribute_id,
                    'attribute_value_id' => $value->attribute_value_id,
                    'created_at'         => $value->created_at,
                    'updated_at'         => $value->updated_at,
                ]);
            }

            DB::table('product_variant_values')->where('product_variant_id', $row->id)->delete();
        }

        DB::table('product_variants')->whereNull('pri_attribute_id')->delete();

        // Every remaining product_variants row is now a real size/color
        // variant, so these bulk-only columns and the nullable constraint
        // no longer apply.
        Schema::table('product_variants', function (Blueprint $table) {
            $table->dropColumn(['minimum', 'maximum']);
        });
        DB::statement('ALTER TABLE product_variants MODIFY pri_attribute_id BIGINT UNSIGNED NOT NULL');
    }

    public function down(): void
    {
        DB::statement('ALTER TABLE product_variants MODIFY pri_attribute_id BIGINT UNSIGNED NULL');
        Schema::table('product_variants', function (Blueprint $table) {
            $table->integer('minimum')->nullable();
            $table->integer('maximum')->nullable();
        });

        foreach (DB::table('bulk_products')->get() as $bp) {
            $variantId = DB::table('product_variants')->insertGetId([
                'product_id'       => $bp->product_id,
                'pri_attribute_id' => null,
                'minimum'          => $bp->minimum,
                'maximum'          => $bp->maximum,
                'regular_price'    => $bp->regular_price,
                'sale_price'       => $bp->sale_price,
                'stock'            => 0,
                'created_at'       => $bp->created_at,
                'updated_at'       => $bp->updated_at,
            ]);

            foreach (DB::table('bulk_product_variants')->where('bulk_product_id', $bp->id)->get() as $bpv) {
                DB::table('product_variant_values')->insert([
                    'product_variant_id' => $variantId,
                    'attribute_id'       => $bpv->attribute_id,
                    'attribute_value_id' => $bpv->attribute_value_id,
                    'created_at'         => $bpv->created_at,
                    'updated_at'         => $bpv->updated_at,
                ]);
            }
        }

        DB::table('bulk_product_variants')->delete();
        DB::table('bulk_products')->delete();
    }
};
