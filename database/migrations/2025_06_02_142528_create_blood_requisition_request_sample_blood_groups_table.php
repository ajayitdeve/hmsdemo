<?php

use App\Models\Bloodgroup;
use App\Models\BloodRequisitionRequest;
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
        Schema::create('blood_requisition_request_sample_blood_groups', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(BloodRequisitionRequest::class);
            $table->string("blood_unit_no", 100)->nullable();
            $table->foreignIdFor(Bloodgroup::class);
            $table->string("component", 150)->nullable();
            $table->timestamp("date_time_issued")->nullable();
            $table->string("issued_by", 150)->nullable();
            $table->string("received_by", 150)->nullable();
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
        Schema::dropIfExists('blood_requisition_request_sample_blood_groups');
    }
};
