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
        Schema::create('user_addresses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone_number');
            $table->string('company_name')->nullable();
            $table->string('address');
            $table->string('pincode');
            $table->string('state');
            $table->string('city');
            $table->string('address_type');
            $table->boolean('is_default')->default(false);
            $table->text('latitude')->nullable();
            $table->text('longitude')->nullable();
            $table->text('landmark')->nullable();
            $table->foreignId('created_by')->constrained('users')->onDelete('no action');
            $table->foreignId('updated_by')->nullable()->constrained('users')->onDelete('no action');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::dropIfExists('user_address');
    }
};
