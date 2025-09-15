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
        Schema::create('ipd_doctor_visits', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Ipd::class);
            $table->foreignIdFor(Patient::class);
            $table->string("code")->unique();
            $table->date("service_date")->nullable();
            $table->string("service_type")->nullable();
            $table->foreignIdFor(Doctor::class);
            $table->timestamp("visit_date_time")->nullable();
            $table->foreignIdFor(NurseStation::class);
            $table->unsignedBigInteger("created_by_id");
            $table->integer('is_cancelled')->default(0);
            $table->text('cancelled_reason')->nullable();
            $table->unsignedBigInteger('cancelled_by_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ipd_doctor_visits');
    }
};
