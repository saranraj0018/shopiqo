<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * user_addresses (created_by/updated_by, is_default, company_name,
     * lat/long, landmark) was a first draft with no rows in it yet — this
     * is the real schema, keyed by user_id directly.
     */
    public function up(): void
    {
        Schema::dropIfExists('user_addresses');

        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('name')->nullable();
            $table->string('phone_number')->nullable();
            $table->text('address')->nullable();
            $table->string('address_type')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('pincode')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('no action');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
