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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_id')->default('#20250320125942');
            $table->string('user_id'); // you used varchar in DB
            $table->longText('address_id'); // as per your structure
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->enum('status', ['1', '2', '3', '4', '5', '6'])->default('1');
            $table->double('net_amount');
            $table->double('shipping_amount')->default(0);
            $table->double('gross_amount');
            $table->double('gst_amount')->default(0);
            $table->longText('notes')->nullable();
            $table->tinyInteger('rating_status')->default(0);
            $table->integer('coupon_id')->nullable();
            $table->double('coupon_amount')->nullable();
            $table->dateTime('shipped_at')->nullable();
            $table->dateTime('delivered_at')->nullable();
            $table->timestamp('cancelled_at')->nullable();
            $table->timestamp('refunded_at')->nullable();
            $table->string('refund_image')->nullable();
            $table->text('refund_note')->nullable();
            $table->text('cancellation_reason')->nullable();
            $table->integer('created_by');
            $table->integer('updated_by')->nullable();
            $table->timestamps();
        });

        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('variant_id');
            $table->unsignedBigInteger('variant_size_id')->nullable();
            $table->unsignedBigInteger('variant_color_id')->nullable();
            $table->string('product_name');
            $table->text('product_image')->nullable();
            $table->string('product_size')->nullable();
            $table->integer('quantity');
            $table->decimal('unit_price', 10, 2);
            $table->decimal('net_amount', 10, 2);
            $table->tinyInteger('gst_type')->default(1);
            $table->integer('gst_percentage')->default(12);
            $table->decimal('gst_amount', 10, 2)->default(0);
            $table->bigInteger('weight')->nullable();
            $table->timestamps();

            // (Optional but recommended) Indexes
            $table->index('order_id');
            $table->index('product_id');
            $table->index('variant_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::dropIfExists('orders');
    }
};
