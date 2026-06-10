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
        Schema::create('product_vendor', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->foreignId('vendor_id')->constrained()->onDelete('cascade');
            $table->decimal('price', 15, 2)->nullable(); // Vendor-specific price
            $table->decimal('min_order_quantity', 10, 2)->default(1); // Vendor-specific MOQ
            $table->string('sku')->nullable(); // Vendor-specific SKU
            $table->boolean('is_primary')->default(false); // Primary vendor for this product
            $table->boolean('is_active')->default(true); // Is this vendor currently selling this product
            $table->timestamps();
            
            // Ensure unique combination
            $table->unique(['product_id', 'vendor_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_vendor');
    }
};
