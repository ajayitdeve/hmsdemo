<?php

use App\Models\AnesthesiaType;
use App\Models\Doctor;
use App\Models\Ipd\Ipd;
use App\Models\Ot;
use App\Models\OtBooking;
use App\Models\Patient;
use App\Models\Service\Service;
use App\Models\SurgeryType;
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
        Schema::create('ot_day_cares', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(OtBooking::class)->constrained();
            $table->foreignIdFor(Ipd::class)->constrained();
            $table->foreignIdFor(Patient::class)->constrained();
            $table->string("code", 100)->unique();
            $table->string("type", 150)->nullable();
            $table->foreignIdFor(Service::class)->nullable();
            $table->foreignIdFor(SurgeryType::class)->nullable();
            $table->foreignIdFor(Ot::class)->nullable();
            $table->date("surgery_date");
            $table->integer("duration")->nullable();
            $table->time("from_time")->nullable();
            $table->time("to_time")->nullable();
            $table->foreignIdFor(Doctor::class)->nullable();
            $table->foreignIdFor(AnesthesiaType::class)->nullable();
            $table->longText("diagnosis")->nullable();
            $table->longText("remarks")->nullable();
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
        Schema::dropIfExists('ot_day_cares');
    }
};
