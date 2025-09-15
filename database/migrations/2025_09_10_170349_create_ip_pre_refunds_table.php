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
        Schema::create('ip_pre_refunds', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Ipd::class)->constrained();
            $table->foreignIdFor(Patient::class)->constrained();
            $table->string("refund_no")->unique()->nullable();
            $table->timestamp("refund_date")->nullable();
            $table->decimal('gross_amount', 10, 2);
            $table->decimal('total_advance', 10, 2);
            $table->decimal('due_amount', 10, 2);
            $table->decimal('amount', 10, 2);
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
        Schema::dropIfExists('ip_pre_refunds');
    }
};
