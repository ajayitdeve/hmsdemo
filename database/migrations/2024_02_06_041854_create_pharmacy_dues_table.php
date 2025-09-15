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
        Schema::create('pharmacy_dues', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\StockPoint::class)->constrained();
            $table->foreignIdFor(\App\Models\Patient::class)->constrained();
            $table->foreignIdFor(\App\Models\PatientVisit::class)->constrained();
            $table->foreignIdFor(\App\Models\OpdMedicineReceipt::class)->constrained();
            $table->decimal('total_amount',8,2);
            $table->decimal('paid_amount',8,2);
            $table->decimal('due_amount',8,2);
            $table->boolean('is_due_cleared')->default(false);
            $table->date('due_clrarance_date')->nullable();
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
        Schema::dropIfExists('pharmacy_dues');
    }
};
