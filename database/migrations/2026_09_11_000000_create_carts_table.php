<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('product_id');
            // Set only for "variant" products, where each row IS one specific
            // priced size+color combo. Null for "single" and "bulk" products.
            $table->unsignedBigInteger('product_variant_id')->nullable();
            $table->integer('quantity');
            // Snapshot of the per-unit price at add-to-cart time, so later price
            // changes on the product don't retroactively change what's in the cart.
            $table->decimal('unit_price', 10, 2);
            $table->string('size_label')->nullable();
            $table->string('color_label')->nullable();
            $table->string('print_type')->nullable();
            $table->string('logo_path')->nullable();
            $table->string('logo_side')->nullable();
            $table->unsignedTinyInteger('logo_position_x')->nullable();
            $table->unsignedTinyInteger('logo_position_y')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('product_variant_id')->references('id')->on('product_variants')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
