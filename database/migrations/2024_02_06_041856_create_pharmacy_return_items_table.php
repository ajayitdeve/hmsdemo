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
        Schema::create('pharmacy_return_items', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\OpdMedicineReceipt::class)->constrained();
            $table->foreignIdFor(\App\Models\Pharmacy\PharmacyReturn::class)->constrained();
            $table->foreignIdFor(\App\Models\Item::class)->constrained();
            $table->foreignIdFor(\App\Models\StockPoint::class)->constrained();
            $table->string('batch_no',15)->nullable();
            $table->string('exd',20)->nullable();
            $table->smallInteger('quantity')->nullable();
            $table->decimal('unit_sale_price', 8, 2);
            $table->decimal('amount', 8, 2);
            $table->decimal('discount', 8, 2);
            $table->decimal('taxable_amount', 8, 2);
            $table->decimal('cgst', 8, 2);
            $table->decimal('sgst', 8, 2);
            $table->decimal('total', 8, 2);
            $table->foreignId('created_by_id')->nullable()->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('approved_by_id')->nullable()->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pharmacy_return_items');
    }
};
