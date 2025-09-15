<?php


use App\Models\OpdBilling;
use App\Models\PatientType;
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
        Schema::create('diagnostic_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->nullable()->constrained('patients')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('patient_visit_id')->nullable()->constrained('patient_visits')->onDelete('cascade')->onUpdate('cascade');
            //for outside patient
            $table->foreignId('out_side_patient_id')->nullable()->constrained('out_side_patients')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('doctor_id')->nullable()->constrained('doctors')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignIdFor(\App\Models\Pathology\SampleCollection::class);
            $table->foreignIdFor(OpdBilling::class);
            $table->string('ref_no', 20)->nullable();
            $table->string('code', 20)->nullable();
            $table->string('patient_type', 20)->nullable();


            $table->boolean('status')->default(0);
            $table->string('result_date', 20)->nullable();
            $table->foreignId('created_by_id')->nullable()->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('updated_by_id')->nullable()->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('approved_by_id')->nullable()->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diagnostic_results');
    }
};
