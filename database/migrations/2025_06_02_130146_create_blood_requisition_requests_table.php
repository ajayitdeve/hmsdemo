<?php

use App\Models\Bloodgroup;
use App\Models\Doctor;
use App\Models\Ipd\Ipd;
use App\Models\OutSidePatient;
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
        Schema::create('blood_requisition_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Ipd::class)->nullable();
            $table->foreignIdFor(Patient::class)->nullable();
            $table->string("code", 100)->unique();
            $table->string("type", 150)->nullable();
            $table->foreignIdFor(OutSidePatient::class)->nullable();
            $table->foreignIdFor(Bloodgroup::class);
            $table->foreignIdFor(Doctor::class);
            $table->string("whole_blood", 150)->nullable();
            $table->string("ffp", 150)->nullable();
            $table->string("hb", 150)->nullable();
            $table->string("pt", 150)->nullable();
            $table->string("prbc", 150)->nullable();
            $table->string("epp", 150)->nullable();
            $table->string("pulse", 150)->nullable();
            $table->string("ptt", 150)->nullable();
            $table->string("pu", 150)->nullable();
            $table->string("cryoprecipitate", 150)->nullable();
            $table->string("bp", 150)->nullable();
            $table->string("pvu_level", 150)->nullable();
            $table->string("ldrbc", 150)->nullable();
            $table->string("onrbc_ab_plasma", 150)->nullable();
            $table->string("weight", 150)->nullable();
            $table->string("s_albumin", 150)->nullable();
            $table->string("pc", 150)->nullable();
            $table->string("onrbc_ab_plasma_2", 150)->nullable();
            $table->string("reason_for_over_ride", 150)->nullable();
            $table->string("status", 150)->nullable();
            $table->unsignedBigInteger('created_by_id');
            $table->unsignedBigInteger('updated_by_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blood_requisition_requests');
    }
};
