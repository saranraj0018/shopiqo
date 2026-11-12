<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Vendors are Admin accounts (role "Vendor") that the public can apply
     * for from the storefront, so they default unapproved — everything else
     * (seeded admins, admins created via the code-gated /admin/register)
     * stays approved as before.
     */
    public function up(): void
    {
        Schema::table('admins', function (Blueprint $table) {
            $table->boolean('is_approved')->default(true)->after('code');
            $table->string('business_name')->nullable()->after('is_approved');
            $table->string('business_type')->nullable()->after('business_name');
            $table->string('gst_number')->nullable()->after('business_type');
            $table->text('business_address')->nullable()->after('gst_number');
            $table->text('products_offered')->nullable()->after('business_address');
        });
    }

    public function down(): void
    {
        Schema::table('admins', function (Blueprint $table) {
            $table->dropColumn(['is_approved', 'business_name', 'business_type', 'gst_number', 'business_address', 'products_offered']);
        });
    }
};
