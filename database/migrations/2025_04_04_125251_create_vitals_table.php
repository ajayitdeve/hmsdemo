<?php

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
        Schema::create('vitals', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Ipd::class);
            $table->foreignIdFor(Patient::class);
            $table->dateTime("date_time")->nullable();
            $table->string("bp")->nullable();
            $table->string("bp_unit")->default("mmHg");
            $table->string("temperature")->nullable();
            $table->string("temperature_unit")->default("°F");
            $table->string("height")->nullable();
            $table->string("height_unit")->default("cm");
            $table->string("weight")->nullable();
            $table->string("weight_unit")->default("kg");
            $table->string("pulse")->nullable();
            $table->string("pulse_unit")->default("bpm");
            $table->string("respiration")->nullable();
            $table->string("respiration_unit")->default("breaths/min");
            $table->string("cvp")->nullable();
            $table->string("cvp_unit")->default("mmHg");
            $table->string("saturation")->nullable();
            $table->string("saturation_unit")->default("%(SpO₂)");
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
        Schema::dropIfExists('vitals');
    }
};
