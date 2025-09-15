<?php

use App\Models\AdminType;
use App\Models\AdmissionPurpose;
use App\Models\CaseType;
use App\Models\Doctor;
use App\Models\Ipd\Bed;
use App\Models\Ipd\Room;
use App\Models\Ipd\Ward;
use App\Models\Nationality;
use App\Models\Unit;
use App\Models\Patient;
use App\Models\Referral;
use App\Models\CostCenter;
use App\Models\Department;
use App\Models\Ipd\CorporateRegistration;
use App\Models\Ipd\Ipd;
use App\Models\PatientVisit;
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
        Schema::create('ipds', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Patient::class)->constrained();
            $table->foreignIdFor(PatientVisit::class)->constrained();
            $table->foreignIdFor(CostCenter::class)->constrained();
            $table->foreignIdFor(CorporateRegistration::class)->nullable();
            $table->foreignIdFor(Department::class)->constrained();
            $table->foreignIdFor(Unit::class)->constrained();


            $table->foreignIdFor(Ward::class)->constrained();
            $table->foreignIdFor(Room::class)->constrained();
            $table->foreignIdFor(Bed::class)->constrained();

            $table->foreignIdFor(Referral::class)->constrained();
            $table->foreignIdFor(Nationality::class)->constrained();
            $table->foreignIdFor(AdminType::class)->constrained();
            $table->foreignId('case_type_id')->nullable()->constrained('case_types')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('admission_purpose_id')->nullable()->constrained('admission_purposes')->onDelete('cascade')->onUpdate('cascade');

            $table->string('ipdcode', 20)->nullable();
            $table->string('reason')->nullable();
            $table->string('company')->nullable();

            $table->string('policy_no', 20)->nullable();
            $table->enum('payment_by', ['Personal', 'Corporate', 'Insurance'])->default('Personal');
            $table->decimal('payment', 8, 2)->nullable();
            $table->decimal('exp_app_amt', 8, 2)->nullable();
            $table->enum('diet', ['Veg', 'NonVeg'])->default('Veg');
            $table->enum('admit_type', ['Walking', 'Wheel Chair', 'Streatcher'])->nullable();
            $table->integer('expected_stay_days')->nullable();
            $table->string('mother_admission_no', 30)->nullable();
            $table->boolean('is_with_mother')->default(false);
            $table->string('pan_no', 30)->nullable();
            $table->enum('type_of_admin', ['Package', 'Non Package'])->nullable(); //Package  Non Package
            $table->decimal('estimated_amt', 8, 2)->nullable();
            $table->enum('patient_source', ['OP', 'Emergency'])->default('OP'); //OP Emergency
            $table->string('passport_no', 30)->nullable();
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
        Schema::dropIfExists('ipds');
    }
};
