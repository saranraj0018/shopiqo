<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Bulk quantity-tier pricing used to be stored as product_variants rows
     * with pri_attribute_id NULL — overloading a table meant for real
     * size/color variants. These are dedicated tables for it, finally
     * giving the long-unused BulkProduct/BulkProductVariant models a home.
     */
    public function up(): void
    {
        Schema::create('bulk_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->integer('minimum')->nullable();
            $table->integer('maximum')->nullable();
            $table->decimal('regular_price', 10, 2)->nullable();
            $table->decimal('sale_price', 10, 2)->nullable();

            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products')->onDelete('no action');
        });

        Schema::create('bulk_product_variants', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bulk_product_id');
            $table->unsignedBigInteger('attribute_id');
            $table->unsignedBigInteger('attribute_value_id');

            $table->timestamps();

            $table->foreign('bulk_product_id')->references('id')->on('bulk_products')->onDelete('no action');
            $table->foreign('attribute_id')->references('id')->on('variant_attributes')->onDelete('no action');
            $table->foreign('attribute_value_id')->references('id')->on('variant_attribute_values')->onDelete('no action');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bulk_product_variants');
        Schema::dropIfExists('bulk_products');
    }
};
