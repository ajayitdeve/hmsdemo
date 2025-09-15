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
        Schema::create('ip_lab_indents', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Ipd::class);
            $table->foreignIdFor(Patient::class);
            $table->string("code")->unique();
            $table->string("remarks")->nullable();
            $table->string("instructions")->nullable();
            $table->string("clinical_summary_diagnosis")->nullable();
            $table->string("status")->nullable();
            $table->foreignIdFor(NurseStation::class)->nullable();
            $table->unsignedBigInteger('created_by_id')->nullable();
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
        Schema::dropIfExists('ip_lab_indents');
    }
};
