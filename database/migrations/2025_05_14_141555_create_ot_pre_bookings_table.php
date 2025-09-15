<?php

use App\Models\Doctor;
use App\Models\Ipd\Ipd;
use App\Models\OutSidePatient;
use App\Models\Patient;
use App\Models\Service\Service;
use App\Models\SurgeryType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use PhpParser\Comment\Doc;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ot_pre_bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Ipd::class)->nullable();
            $table->foreignIdFor(Patient::class)->nullable();
            $table->string("code", 100)->unique();
            $table->foreignIdFor(Doctor::class);
            $table->foreignIdFor(Service::class);
            $table->foreignIdFor(SurgeryType::class)->nullable();
            $table->enum("for_day_care", [0, 1])->default('0');
            $table->string("type", 150)->nullable();
            $table->foreignIdFor(OutSidePatient::class)->nullable();
            $table->string("booking_type", 150)->nullable();
            $table->timestamp("surgery_date");
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
        Schema::dropIfExists('ot_pre_bookings');
    }
};
