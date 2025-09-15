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
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(\App\Models\Vendor::class)->constrained();
            $table->foreignIdFor(\App\Models\StockPoint::class)->constrained();
            $table->foreignIdFor(\App\Models\PurchaseTerm::class)->constrained();
            $table->foreignIdFor(\App\Models\PurchaseIndent::class)->constrained();
            $table->string('code',15);
            // $table->decimal('subtotal', 10, 2);
            // $table->decimal('discount', 7, 2);
            // $table->decimal('taxamount', 7, 2);
            // $table->decimal('total', 10, 2);
            $table->boolean('status')->default(0);
            $table->string('remarks')->nullable();
            $table->foreignId('created_by_id')->nullable()->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_orders');
    }
};
