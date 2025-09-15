<?php

use App\Models\Doctor;
use App\Models\Ipd\CorporateRegistration;
use App\Models\Ipd\Organization;
use App\Models\Patient;
use App\Models\PatientVisit;
use App\Models\VisitType;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('corporate_consultations', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(CorporateRegistration::class);
            $table->foreignIdFor(Organization::class);
            $table->foreignIdFor(Patient::class);
            $table->foreignIdFor(PatientVisit::class);
            $table->string("code", 20)->unique();
            $table->string("type", 20)->nullable();
            $table->string("payment_by", 50)->nullable();
            $table->foreignIdFor(VisitType::class);
            $table->foreignIdFor(Doctor::class);
            $table->text("chief_complaint")->nullable();
            $table->text("remarks")->nullable();
            $table->unsignedBigInteger("created_by_id")->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('corporate_consultations');
    }
};
