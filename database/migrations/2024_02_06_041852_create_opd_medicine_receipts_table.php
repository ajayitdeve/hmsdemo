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
        Schema::create('opd_medicine_receipts', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\StockPoint::class)->constrained();
            $table->foreignIdFor(\App\Models\Patient::class)->constrained()->nullable()->default(null);
            $table->foreignIdFor(\App\Models\PatientVisit::class)->constrained()->nullable()->default(null);
            $table->foreignId('out_side_patient_id')->nullable()->constrained('out_side_patients')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('created_by_id')->nullable()->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->enum('patient_type',['op','ip','outside'])->default('op');
            $table->string('code',30)->nullable();

            $table->decimal('gross_amount', 8, 2)->nullable();
            $table->decimal('discount_amount', 8, 2)->nullable();
            $table->decimal('due_amount', 8, 2)->nullable();
            $table->decimal('advance_amount', 8, 2)->nullable();
            $table->decimal('other_amount', 8, 2)->nullable();
            $table->decimal('total_amount', 8, 2)->nullable();
            $table->decimal('paid_amount', 8, 2)->nullable();
            $table->string('payment_by', 20)->nullable();
            $table->string('transaction_id', 150)->nullable();

            $table->boolean('is_cancled')->default(false)->nullable();
            $table->string('cancled_date',20)->nullable()->default(null);
            $table->foreignId('cancle_by_id')->nullable()->default(null)->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('opd_medicine_receipts');
    }
};