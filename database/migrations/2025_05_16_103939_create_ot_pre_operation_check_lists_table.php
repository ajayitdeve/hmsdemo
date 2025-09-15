<?php

use App\Models\Bloodgroup;
use App\Models\Ipd\Ipd;
use App\Models\OtPreOperation;
use App\Models\Patient;
use App\Models\Service\Service;
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
        Schema::create('ot_pre_operation_check_lists', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(OtPreOperation::class)->constrained();
            $table->foreignIdFor(Ipd::class)->constrained();
            $table->foreignIdFor(Patient::class)->constrained();
            $table->string("code", 100)->unique();
            $table->foreignIdFor(Service::class)->constrained();
            $table->date("surgery_date");
            $table->foreignIdFor(Bloodgroup::class)->constrained();
            $table->string("weight", 50)->nullable();
            $table->string("height", 50)->nullable();
            $table->timestamp("last_food_date")->nullable();
            $table->timestamp("last_fluid_date")->nullable();
            $table->string("escort_nurse", 150)->nullable();
            $table->string("theater_nurse", 150)->nullable();
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
        Schema::dropIfExists('ot_pre_operation_check_lists');
    }
};
