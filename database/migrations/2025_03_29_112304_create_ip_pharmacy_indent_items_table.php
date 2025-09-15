<?php

use App\Models\IpPharmacyIndent;
use App\Models\Item;
use App\Models\StockPoint;
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
        Schema::create('ip_pharmacy_indent_items', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(IpPharmacyIndent::class);
            $table->foreignIdFor(Item::class);
            $table->foreignIdFor(StockPoint::class);
            $table->string('batch_no');
            $table->date('exd');
            $table->integer('quantity');
            $table->decimal('unit_sale_price', 10, 2);
            $table->decimal('amount', 10, 2);
            $table->decimal('discount', 10, 2)->default(0);
            $table->decimal('taxable_amount', 10, 2);
            $table->decimal('cgst', 10, 2)->default(0);
            $table->decimal('sgst', 10, 2)->default(0);
            $table->decimal('total', 10, 2);
            $table->unsignedBigInteger('discount_approved_by_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ip_pharmacy_indent_items');
    }
};
