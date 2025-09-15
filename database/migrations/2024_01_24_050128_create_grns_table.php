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
        Schema::create('grns', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Vendor::class)->constrained();
            $table->foreignIdFor(\App\Models\PurchaseOrder::class)->constrained();
            $table->string('code',15);
            $table->string('invoice_no',15);
            $table->string('invoice_date',25);
            $table->decimal('invoice_value', 10, 2);
            // $table->decimal('subtotal', 10, 2);
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
        Schema::dropIfExists('grns');
    }
};
