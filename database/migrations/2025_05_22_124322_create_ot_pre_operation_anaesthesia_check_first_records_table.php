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
        Schema::create('ot_pre_operation_anaesthesia_check_first_records', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(OtPreOperation::class);
            $table->timestamp('date')->nullable();
            $table->string('height', 50)->nullable();
            $table->string('weight', 50)->nullable();
            $table->string('bmi', 50)->nullable();
            $table->text('community')->nullable();
            $table->string('anaesthesia')->nullable();
            $table->string('dept')->nullable();
            $table->string('sx_plan')->nullable();
            $table->string('surgeon')->nullable();

            $table->string('risk_factors')->nullable();
            $table->string('allergy')->nullable();
            $table->longText('current_drug_r')->nullable();
            $table->tinyInteger('sht')->default(0);
            $table->tinyInteger('cad')->default(0);
            $table->tinyInteger('post_cabg')->default(0);
            $table->tinyInteger('post_ptca')->default(0);
            $table->tinyInteger('post_dvt')->default(0);
            $table->tinyInteger('post_pre')->default(0);
            $table->tinyInteger('dm')->default(0);
            $table->tinyInteger('ba')->default(0);
            $table->tinyInteger('copd')->default(0);
            $table->tinyInteger('cva')->default(0);
            $table->tinyInteger('resp_infection')->default(0);
            $table->tinyInteger('smoker')->default(0);
            $table->tinyInteger('alcoholic')->default(0);
            $table->tinyInteger('anticoagulant')->default(0);
            $table->tinyInteger('osa')->default(0);
            $table->tinyInteger('hyper_thyroid')->default(0);
            $table->tinyInteger('hypothroid')->default(0);
            $table->tinyInteger('obesity')->default(0);
            $table->tinyInteger('fits')->default(0);
            $table->tinyInteger('antiplatlet')->default(0);
            $table->tinyInteger('chronic_pain')->default(0);
            $table->tinyInteger('long_term_steroid')->default(0);
            $table->tinyInteger('antiepileptic')->default(0);

            $table->tinyInteger('ho_eventful_preoperative_period')->default(0);
            $table->tinyInteger('ho_previous_sx')->default(0);
            $table->tinyInteger('ho_eventful_anaesthesia')->default(0);

            $table->tinyInteger('cough')->default(0);
            $table->tinyInteger('wheezing')->default(0);
            $table->tinyInteger('sputum')->default(0);
            $table->tinyInteger('recent_lri_uri')->default(0);
            $table->tinyInteger('anaemia')->default(0);
            $table->tinyInteger('jaundice')->default(0);
            $table->tinyInteger('cyanosis')->default(0);
            $table->tinyInteger('clubbing')->default(0);
            $table->tinyInteger('pedal_edema')->default(0);

            $table->text('airway_spine')->nullable();
            $table->tinyInteger('ltd_mo')->default(0);
            $table->tinyInteger('bucked_tooth')->default(0);
            $table->tinyInteger('loose_tooth')->default(0);
            $table->tinyInteger('denture')->default(0);
            $table->tinyInteger('short_neck')->default(0);
            $table->tinyInteger('receding_mandible')->default(0);
            $table->tinyInteger('rnm')->default(0);
            $table->tinyInteger('hyphosis')->default(0);
            $table->tinyInteger('adentulous')->default(0);
            $table->tinyInteger('scoliosis')->default(0);
            $table->tinyInteger('lordosis')->default(0);
            $table->text('others')->nullable();
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
        Schema::dropIfExists('ot_pre_operation_anaesthesia_check_first_records');
    }
};
