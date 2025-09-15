<?php

use App\Models\Donor;
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
        Schema::create('blood_donor_questionnaire_consents', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Ipd::class)->nullable();
            $table->foreignIdFor(Patient::class)->nullable();
            $table->foreignIdFor(Donor::class)->constrained();
            $table->string("blood_bag_no", 100)->nullable();
            $table->string("code", 50)->nullable();
            $table->tinyInteger("voluntary")->nullable()->default(0);
            $table->tinyInteger("call_status")->nullable()->default(0);
            $table->text("call_status_remarks")->nullable();
            $table->tinyInteger("donation_status")->nullable()->default(0);
            $table->string("donation_occasion", 50)->nullable();
            $table->string("last_meal", 100)->nullable();
            $table->string("last_blood_donated", 100)->nullable();
            $table->string("last_meal_time", 100)->nullable();
            $table->tinyInteger("discomfort_status")->nullable()->default(0);
            $table->text("discomfort_status_remarks")->nullable();
            $table->tinyInteger("well_status")->nullable()->default(0);
            $table->text("well_status_remarks")->nullable();
            $table->tinyInteger("eat_status")->nullable()->default(0);
            $table->text("eat_status_remarks")->nullable();
            $table->tinyInteger("sleep_status")->nullable()->default(0);
            $table->text("sleep_status_remarks")->nullable();
            $table->tinyInteger("reason_status")->nullable()->default(0);
            $table->text("reason_status_remarks")->nullable();
            $table->tinyInteger("unexplained_weight_loss")->nullable()->default(0);
            $table->tinyInteger("swollen_gland")->nullable()->default(0);
            $table->tinyInteger("repeated_diarrhoea")->nullable()->default(0);
            $table->tinyInteger("continuous_low_grade_fever")->nullable()->default(0);
            $table->tinyInteger("tattooing")->nullable()->default(0);
            $table->tinyInteger("ear_piarcing")->nullable()->default(0);
            $table->tinyInteger("dental_extration")->nullable()->default(0);
            $table->tinyInteger("heart_disease")->nullable()->default(0);
            $table->tinyInteger("lung_disease")->nullable()->default(0);
            $table->tinyInteger("kedney_disease")->nullable()->default(0);
            $table->tinyInteger("cancer_disease")->nullable()->default(0);
            $table->tinyInteger("epilepsy")->nullable()->default(0);
            $table->tinyInteger("diabetes")->nullable()->default(0);
            $table->tinyInteger("tuberculosis")->nullable()->default(0);
            $table->tinyInteger("abnormal_bleeding_tendency")->nullable()->default(0);
            $table->tinyInteger("hepatitis_bc")->nullable()->default(0);
            $table->tinyInteger("allergic_disease")->nullable()->default(0);
            $table->tinyInteger("jaundice")->nullable()->default(0);
            $table->tinyInteger("sexual_transmitted_disease")->nullable()->default(0);
            $table->tinyInteger("malaria")->nullable()->default(0);
            $table->tinyInteger("typhoid")->nullable()->default(0);
            $table->tinyInteger("fainting_spells")->nullable()->default(0);
            $table->tinyInteger("antibiotics")->nullable()->default(0);
            $table->tinyInteger("aspirin")->nullable()->default(0);
            $table->tinyInteger("alcohol")->nullable()->default(0);
            $table->tinyInteger("steroids")->nullable()->default(0);
            $table->tinyInteger("vaccinations")->nullable()->default(0);
            $table->tinyInteger("dog_bites_rabies_vaccine")->nullable()->default(0);
            $table->tinyInteger("major")->nullable()->default(0);
            $table->tinyInteger("minor")->nullable()->default(0);
            $table->tinyInteger("bt")->nullable()->default(0);
            $table->tinyInteger("pregnant_status")->nullable()->default(0);
            $table->tinyInteger("aberration_status")->nullable()->default(0);
            $table->tinyInteger("child_status")->nullable()->default(0);
            $table->tinyInteger("abnormal_test_result")->nullable()->default(0);
            $table->tinyInteger("read_and_understand")->nullable()->default(0);
            $table->tinyInteger("accept_terms")->nullable()->default(1);

            $table->string("weight", 10)->nullable();
            $table->integer("pulse")->nullable();
            $table->string("hb", 10)->nullable();
            $table->string("bp", 20)->nullable();
            $table->string("temperature", 20)->nullable();
            $table->string("reason", 255)->nullable();

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
        Schema::dropIfExists('blood_donor_questionnaire_consents');
    }
};
