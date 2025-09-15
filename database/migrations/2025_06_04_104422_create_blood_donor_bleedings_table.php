<?php

use App\Models\BagType;
use App\Models\BloodDonorQuestionnaireConsent;
use App\Models\Bloodgroup;
use App\Models\Doctor;
use App\Models\Donor;
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
        Schema::create('blood_donor_bleedings', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Ipd::class)->nullable();
            $table->foreignIdFor(Patient::class)->nullable();
            $table->string("type", 150)->nullable();
            $table->foreignIdFor(OutSidePatient::class)->nullable();
            $table->foreignIdFor(Donor::class)->constrained();
            $table->foreignIdFor(BloodDonorQuestionnaireConsent::class)->nullable();
            $table->string("code", 100)->unique();
            $table->string("blood_bag_no", 100)->unique();
            $table->foreignIdFor(BagType::class)->nullable();
            $table->foreignIdFor(Bloodgroup::class)->nullable();
            $table->string("volume", 50)->nullable();
            $table->string("tube_no", 50)->nullable();
            $table->string("temperature", 10)->nullable();
            $table->string("hemoglobin", 100)->nullable();
            $table->string("lagtime", 100)->nullable();
            $table->string("weight", 100)->nullable();
            $table->string("pulse", 100)->nullable();
            $table->timestamp("bleeding_from_time")->nullable();
            $table->timestamp("bleeding_to_time")->nullable();
            $table->string("phlebotomy_site", 100)->nullable();
            $table->string("bp", 50)->nullable();
            $table->string("phlebotomist", 150)->nullable();
            $table->string("staff_nurse", 150)->nullable();
            $table->foreignIdFor(Doctor::class)->nullable();
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
        Schema::dropIfExists('blood_donor_bleedings');
    }
};
