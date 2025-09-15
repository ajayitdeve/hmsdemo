<?php

use App\Models\Ipd\Ipd;
use App\Models\OtBooking;
use App\Models\OtPreOperation;
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
        Schema::create('ot_post_operations', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(OtBooking::class)->constrained();
            $table->foreignIdFor(OtPreOperation::class)->constrained();
            $table->foreignIdFor(Ipd::class)->constrained();
            $table->foreignIdFor(Patient::class)->constrained();
            $table->string("code", 100)->unique();
            $table->foreignIdFor(Service::class)->nullable();
            $table->foreignIdFor(SurgeryType::class)->nullable();
            $table->date("surgery_date");
            $table->integer("duration")->nullable();
            $table->timestamp("ot_start_time")->nullable();
            $table->timestamp("ot_end_time")->nullable();
            $table->foreignIdFor(OtType::class)->constrained();
            $table->string("blood_loss", 150)->nullable();
            $table->tinyInteger("sent_to_icu")->nullable()->default(0);
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
        Schema::dropIfExists('ot_post_operations');
    }
};
