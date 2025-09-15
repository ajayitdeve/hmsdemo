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
        Schema::create('purchase_order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\PurchaseOrder::class)->constrained();
            $table->foreignIdFor(\App\Models\Item::class)->constrained();
            $table->smallInteger('quantity')->default(0);
            $table->decimal('unitrate', 8, 2);
            $table->decimal('unitsalerate', 8, 2);
            $table->tinyInteger('bonus')->default(0);
            $table->decimal('discount_percent', 5, 2)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_order_items');
    }
};
