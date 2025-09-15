<?php

use App\Models\AnesthesiaType;
use App\Models\Doctor;
use App\Models\Ipd\Ipd;
use App\Models\Ot;
use App\Models\OtType;
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
        Schema::create('ot_bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Ipd::class);
            $table->foreignIdFor(Patient::class);
            $table->string("code", 100)->unique();
            $table->foreignIdFor(Doctor::class);
            $table->foreignIdFor(Service::class);
            $table->foreignIdFor(SurgeryType::class)->nullable();
            $table->string("booking_type", 150)->nullable();
            $table->integer("duration")->nullable();
            $table->date("surgery_date");
            $table->foreignIdFor(OtType::class);
            $table->time("from_time")->nullable();
            $table->time("to_time")->nullable();
            $table->foreignIdFor(Ot::class);
            $table->foreignIdFor(AnesthesiaType::class)->nullable();
            $table->enum("for_day_care", [0, 1])->default('0');
            $table->string("icd_code", 50)->nullable();
            $table->string("cpt_code", 50)->nullable();
            $table->longText("remarks")->nullable();
            $table->longText("diagnosis")->nullable();
            $table->unsignedBigInteger('created_by_id');
            $table->integer('is_cancelled')->default(0);
            $table->text('cancelled_reason')->nullable();
            $table->unsignedBigInteger('cancelled_approved_by_id')->nullable();
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
        Schema::dropIfExists('ot_bookings');
    }
};
