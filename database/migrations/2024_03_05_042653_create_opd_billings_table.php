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
        Schema::create('opd_billings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->nullable()->constrained('patients')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('patient_visit_id')->nullable()->constrained('patient_visits')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('out_side_patient_id')->nullable()->constrained('out_side_patients')->onDelete('cascade')->onUpdate('cascade');
            // $table->foreignIdFor(\App\Models\Patient::class)->constrained()->nullable();
            // $table->foreignIdFor(\App\Models\PatientVisit::class)->constrained()->nullable();
            // $table->foreignIdFor(\App\Models\OutSidePatient::class)->constrained()->nullable();

            $table->string('code', 30)->nullable();
            $table->decimal('total', 8, 2);
            $table->decimal('paid', 8, 2);
            $table->decimal('balance', 8, 2);
            $table->enum('patient_type', ['op', 'ip', 'outside'])->default('op');
            $table->decimal('gross_amount', 8, 2)->nullable();
            $table->decimal('discount_amount', 8, 2)->nullable();
            $table->decimal('due_amount', 8, 2)->nullable();
            $table->decimal('advance_amount', 8, 2)->nullable();
            $table->decimal('other_amount', 8, 2)->nullable();
            $table->decimal('total_amount', 8, 2)->nullable();
            $table->decimal('paid_amount', 8, 2)->nullable();
            $table->string('payment_by', 20)->nullable();
            $table->string('transaction_id', 150)->nullable();
            $table->boolean('is_overall_discount')->default(false);
            $table->foreignId('created_by_id')->nullable()->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->tinyInteger('is_cancled')->nullable()->default(0);
            $table->text('cancled_reason')->nullable();
            $table->string('cancled_date', 50)->nullable();
            $table->unsignedBigInteger('cancled_approve_by_id')->nullable();
            $table->unsignedBigInteger('cancle_by_id')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('opd_billings');
    }
};
