<?php

use App\Models\OtPreOperationCheckList;
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
        Schema::create('ot_pre_operation_patient_check_lists', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(OtPreOperationCheckList::class);

            $table->boolean('name_and_hospital_number_on_wrist_band')->default(false);
            $table->boolean('surgery_consent_form_completed_and_signed_by_patient_and_wintess')->default(false);
            $table->boolean('pre_medication_given_as_ordered_and_time_given')->default(false);
            $table->boolean('correct_area_shaved_and_prepared')->default(false);
            $table->boolean('weight_trp_bp_recorded_and_allergies_listed')->default(false);
            $table->boolean('dentures_removed_or_accompanying_the_patient')->default(false);
            $table->boolean('xrays_ct_scan_and_mri_films_other_report')->default(false);
            $table->boolean('total_no_of_films_sent_to_ot')->default(false);
            $table->string('x_rays', 100)->nullable();
            $table->string('ct', 100)->nullable();
            $table->string('mri', 100)->nullable();

            $table->boolean('bath_given')->default(false);
            $table->boolean('nail_polish_removed')->default(false);
            $table->boolean('hair_clips_removed')->default(false);
            $table->boolean('jewellery_removed')->default(false);
            $table->boolean('contact_lens_removed')->default(false);
            $table->boolean('hearing_aid_must_goto_theatre')->default(false);
            $table->boolean('rings_nose_and_ear_studs_taped')->default(false);
            $table->boolean('false_eye_mention_which_side')->default(false);
            $table->string('eye_mention_side', 100)->nullable();

            $table->boolean('is_old_notes')->default(false);
            $table->text('old_notes')->nullable();

            $table->boolean('is_other_prostheses_specify_if_any')->default(false);
            $table->text('other_prostheses_specify_if_any')->nullable();

            $table->boolean('is_urine_passed_time_and_volume')->default(false);
            $table->timestamp('urine_passed_time')->nullable();
            $table->string('urine_passed_volume', 100)->nullable();

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
        Schema::dropIfExists('ot_pre_operation_patient_check_lists');
    }
};
