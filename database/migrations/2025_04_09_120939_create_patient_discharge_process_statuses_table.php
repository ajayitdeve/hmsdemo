<?php

use App\Models\Doctor;
use App\Models\Ipd\Ipd;
use App\Models\Ipd\NurseStation;
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
        Schema::create('patient_discharge_process_statuses', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Ipd::class);
            $table->foreignIdFor(Patient::class);
            $table->foreignIdFor(Doctor::class);
            $table->string("place")->nullable();
            $table->time("time")->nullable();
            $table->enum("is_return_pharmacy", [0, 1])->default(0);
            $table->enum("is_amubulance", [0, 1])->default(0);
            $table->longText("notes")->nullable();
            $table->longText("remarks")->nullable();
            $table->foreignIdFor(NurseStation::class);
            $table->unsignedBigInteger("created_by_id");
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patient_discharge_process_statuses');
    }
};
