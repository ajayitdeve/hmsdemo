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
        Schema::create('ipd_equipment_usages', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Ipd::class);
            $table->foreignIdFor(Patient::class);
            $table->string("code")->unique();
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
        Schema::dropIfExists('ipd_equipment_usages');
    }
};
