<?php

use App\Models\OtPostOperation;
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
        Schema::create('ot_post_operation_unit_records', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(OtPostOperation::class);

            // Pulse Rate
            $table->string('pulse_rate_in', 100)->nullable();
            $table->string('pulse_rate_15', 100)->nullable();
            $table->string('pulse_rate_30', 100)->nullable();
            $table->string('pulse_rate_45', 100)->nullable();
            $table->string('pulse_rate_60', 100)->nullable();
            $table->string('pulse_rate_75', 100)->nullable();
            $table->string('pulse_rate_90', 100)->nullable();
            $table->string('pulse_rate_105', 100)->nullable();
            $table->string('pulse_rate_120', 100)->nullable();

            // Blood Pressure
            $table->string('bp_in', 100)->nullable();
            $table->string('bp_15', 100)->nullable();
            $table->string('bp_30', 100)->nullable();
            $table->string('bp_45', 100)->nullable();
            $table->string('bp_60', 100)->nullable();
            $table->string('bp_75', 100)->nullable();
            $table->string('bp_90', 100)->nullable();
            $table->string('bp_105', 100)->nullable();
            $table->string('bp_120', 100)->nullable();

            // Respiratory Rate
            $table->string('rr_in', 100)->nullable();
            $table->string('rr_15', 100)->nullable();
            $table->string('rr_30', 100)->nullable();
            $table->string('rr_45', 100)->nullable();
            $table->string('rr_60', 100)->nullable();
            $table->string('rr_75', 100)->nullable();
            $table->string('rr_90', 100)->nullable();
            $table->string('rr_105', 100)->nullable();
            $table->string('rr_120', 100)->nullable();

            // SpO2
            $table->string('spo2_in', 100)->nullable();
            $table->string('spo2_15', 100)->nullable();
            $table->string('spo2_30', 100)->nullable();
            $table->string('spo2_45', 100)->nullable();
            $table->string('spo2_60', 100)->nullable();
            $table->string('spo2_75', 100)->nullable();
            $table->string('spo2_90', 100)->nullable();
            $table->string('spo2_105', 100)->nullable();
            $table->string('spo2_120', 100)->nullable();

            // Pain Score
            $table->string('pain_score_in', 100)->nullable();
            $table->string('pain_score_15', 100)->nullable();
            $table->string('pain_score_30', 100)->nullable();
            $table->string('pain_score_45', 100)->nullable();
            $table->string('pain_score_60', 100)->nullable();
            $table->string('pain_score_75', 100)->nullable();
            $table->string('pain_score_90', 100)->nullable();
            $table->string('pain_score_105', 100)->nullable();
            $table->string('pain_score_120', 100)->nullable();

            $table->unsignedBigInteger('created_by_id');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ot_post_operation_unit_records');
    }
};
