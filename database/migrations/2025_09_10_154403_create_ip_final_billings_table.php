<?php

use App\Models\Ipd\Ipd;
use App\Models\Patient;
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
        Schema::create('ip_final_billings', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Ipd::class)->constrained();
            $table->foreignIdFor(Patient::class)->constrained();
            $table->string("bill_no")->unique()->nullable();
            $table->timestamp("bill_date")->nullable();
            $table->decimal('gross_amount', 10, 2)->nullable();
            $table->decimal('total_advance', 10, 2)->nullable();
            $table->decimal('excess_amount', 10, 2)->nullable();
            $table->decimal('receipt_amount', 10, 2)->nullable();
            $table->decimal('due_amount', 10, 2)->nullable();
            $table->unsignedBigInteger('due_authorized_by_id', 10, 2)->nullable();
            $table->decimal('concession', 10, 2)->nullable();
            $table->unsignedBigInteger('concession_authorized_by_id', 10, 2)->nullable();
            $table->decimal('amount', 10, 2)->nullable();
            $table->string('payment_mode', 20)->nullable();
            $table->string('transaction_id', 100)->nullable();
            $table->string('remarks')->nullable();
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ip_final_billings');
    }
};
