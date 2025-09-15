<?php

use App\Models\Bloodgroup;
use App\Models\BloodRequisitionRequest;
use App\Models\CostCenter;
use App\Models\Ipd\Ipd;
use App\Models\OutSidePatient;
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
        Schema::create('transfusion_reactions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Ipd::class)->nullable();
            $table->foreignIdFor(Patient::class)->nullable();
            $table->string("type", 150)->nullable();
            $table->foreignIdFor(OutSidePatient::class)->nullable();
            $table->foreignIdFor(BloodRequisitionRequest::class)->nullable();
            $table->foreignIdFor(CostCenter::class)->nullable();
            $table->string("code", 100)->unique();
            $table->timestamp("date_of_issue")->nullable();
            $table->string("name_of_uc", 100)->nullable();
            $table->foreignIdFor(Bloodgroup::class)->nullable();
            $table->string("compatible_with_unit_no", 100)->nullable();
            $table->date("date_of_collection")->nullable();
            $table->date("date_of_expiry")->nullable();
            $table->date("date_of_supply")->nullable();
            $table->time("time_of_supply")->nullable();

            // Add all observation fields
            $table->string('pre_se')->nullable();
            $table->string('during_se')->nullable();
            $table->string('post_se')->nullable();

            $table->string('pre_resp')->nullable();
            $table->string('during_resp')->nullable();
            $table->string('post_resp')->nullable();

            $table->string('pre_temp')->nullable();
            $table->string('during_temp')->nullable();
            $table->string('post_temp')->nullable();

            $table->string('pre_bp')->nullable();
            $table->string('during_bp')->nullable();
            $table->string('post_bp')->nullable();

            $table->string('pre_rigor')->nullable();
            $table->string('during_rigor')->nullable();
            $table->string('post_rigor')->nullable();

            $table->string('pre_chims')->nullable();
            $table->string('during_chims')->nullable();
            $table->string('post_chims')->nullable();

            $table->string('pre_myalgia')->nullable();
            $table->string('during_myalgia')->nullable();
            $table->string('post_myalgia')->nullable();

            $table->string('pre_untians')->nullable();
            $table->string('during_untians')->nullable();
            $table->string('post_untians')->nullable();

            $table->text('pre_other_observation')->nullable();
            $table->text('during_other_observation')->nullable();
            $table->text('post_other_observation')->nullable();

            $table->text('remarks_for_blood_bank')->nullable();
            $table->text('remarks_for_nurse')->nullable();

            $table->tinyInteger('status')->nullable();

            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->unsignedBigInteger('updated_by_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transfusion_reactions');
    }
};
