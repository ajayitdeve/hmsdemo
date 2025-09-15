<?php

use App\Models\DischargeType;
use App\Models\Doctor;
use App\Models\Ipd\Ipd;
use App\Models\Ipd\Organization;
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
        Schema::create('ip_discharges', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Ipd::class)->constrained();
            $table->foreignIdFor(Patient::class)->constrained();
            $table->string("discharge_no", 50)->nullable();
            $table->timestamp("discharge_date")->nullable();
            $table->foreignIdFor(Doctor::class)->nullable()->constrained();
            $table->foreignIdFor(Organization::class)->nullable()->constrained();
            $table->foreignIdFor(DischargeType::class)->nullable()->constrained();
            $table->string("discharge_status", 50)->nullable();
            $table->longText("diagnosis")->nullable();
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
        Schema::dropIfExists('ip_discharges');
    }
};
