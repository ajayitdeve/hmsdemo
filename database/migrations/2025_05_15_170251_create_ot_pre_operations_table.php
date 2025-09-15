<?php

use App\Models\Ipd\Ipd;
use App\Models\Ot;
use App\Models\OtBooking;
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
        Schema::create('ot_pre_operations', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(OtBooking::class)->constrained();
            $table->foreignIdFor(Ipd::class)->constrained();
            $table->foreignIdFor(Patient::class)->constrained();
            $table->string("code", 100)->unique();
            $table->string("type", 150)->nullable();
            $table->foreignIdFor(Service::class)->constrained();
            $table->foreignIdFor(SurgeryType::class)->nullable();
            $table->date("surgery_date");
            $table->integer("duration")->nullable();
            $table->time("from_time")->nullable();
            $table->time("to_time")->nullable();
            $table->foreignIdFor(OtType::class)->constrained();
            $table->foreignIdFor(Ot::class)->constrained();
            $table->timestamp("ot_start_time")->nullable();
            $table->timestamp("estimated_time")->nullable();
            $table->string("icd_code", 50)->nullable();
            $table->string("cpt_code", 50)->nullable();
            $table->longText("op_diagnosis")->nullable();
            $table->longText("op_procedure")->nullable();
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
        Schema::dropIfExists('ot_pre_operations');
    }
};
