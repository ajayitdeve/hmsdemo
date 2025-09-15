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
        Schema::create('intake_output_entries', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Ipd::class);
            $table->foreignIdFor(Patient::class);
            $table->dateTime('date_time');
            $table->string('iv_fluid')->nullable();
            $table->float('iv_hrly');
            $table->float('iv_total');
            $table->string('oral_fluid')->nullable();
            $table->float('oral_amount');
            $table->float('oral_total');
            $table->float('urine');
            $table->float('ngasp_rta');
            $table->float('drainage_d1');
            $table->float('drainage_d2');
            $table->float('drainage_d1_output');
            $table->float('drainage_d2_output');
            $table->float('misc');
            $table->float('sub_total');
            $table->float('total');
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
        Schema::dropIfExists('intake_output_entries');
    }
};
