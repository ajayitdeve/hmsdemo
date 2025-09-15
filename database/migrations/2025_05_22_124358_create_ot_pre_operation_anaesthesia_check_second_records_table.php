<?php

use App\Models\OtPreOperation;
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
        Schema::create('ot_pre_operation_anaesthesia_check_second_records', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(OtPreOperation::class);

            // Supine and Erect vitals
            $table->string('supine', 100)->nullable();
            $table->string('supine_bp', 100)->nullable();
            $table->string('supine_spo2', 100)->nullable();
            $table->string('erect', 100)->nullable();
            $table->string('erect_bp', 100)->nullable();

            // Examination
            $table->string('cvs', 100)->nullable();
            $table->string('rs', 100)->nullable();
            $table->string('pa', 100)->nullable();

            // Blood Investigations
            $table->string('hb', 100)->nullable();
            $table->string('tc', 100)->nullable();
            $table->string('dc', 100)->nullable();
            $table->string('esr', 100)->nullable();
            $table->string('rbs', 100)->nullable();
            $table->string('platlet', 100)->nullable();
            $table->string('bt', 100)->nullable();
            $table->string('pt', 100)->nullable();
            $table->string('inr', 100)->nullable();
            $table->string('aptt', 100)->nullable();
            $table->string('lft', 100)->nullable();
            $table->string('bi_urea', 100)->nullable();
            $table->string('sr_creat', 100)->nullable();

            // Other Tests
            $table->string('ct', 100)->nullable();
            $table->string('hiv', 100)->nullable();
            $table->string('hbsag', 100)->nullable();
            $table->string('hcv', 100)->nullable();
            $table->string('s_electrolytes', 100)->nullable();
            $table->string('blood_gr_rh_typing', 100)->nullable();
            $table->string('ecg', 100)->nullable();
            $table->string('echo', 100)->nullable();
            $table->string('tft', 100)->nullable();
            $table->string('pft', 100)->nullable();
            $table->string('tmt', 100)->nullable();
            $table->string('abg', 100)->nullable();
            $table->string('chest_xray', 100)->nullable();
            $table->string('bill_venous_dopper_abg_for_both_ll', 100)->nullable();

            // Pre-op Evaluations
            $table->text('specialist_opinion_before_surgery', 100)->nullable();
            $table->text('any_further_investigation_required_before_surgery', 100)->nullable();
            $table->string('blood_reserve', 100)->nullable();
            $table->longText('remarks')->nullable();
            $table->text('npo_for')->nullable();
            $table->text('pre_medication')->nullable();

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
        Schema::dropIfExists('ot_pre_operation_anaesthesia_check_second_records');
    }
};
