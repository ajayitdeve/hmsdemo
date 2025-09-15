<?php

use App\Models\OtPostOperation;
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
        Schema::create('ot_post_operation_notes', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(OtPostOperation::class);

            $table->longText('pre_op_diagnosis')->nullable();
            $table->longText('post_op_diagnosis')->nullable();
            $table->longText('procedure_planned')->nullable();
            $table->longText('procedure_performed')->nullable();
            $table->string('surgeon')->nullable();
            $table->string('anesthesiologist')->nullable();
            $table->string('asst_surgeon')->nullable();
            $table->string('staff_nurses')->nullable();
            $table->string('freop_antibiotic')->nullable();
            $table->string('blood_loss')->nullable();
            $table->string('blood_transfusion')->nullable();

            $table->longText('incision')->nullable();
            $table->longText('findings')->nullable();
            $table->longText('procedure')->nullable();
            $table->longText('closure')->nullable();
            $table->longText('post_op_instruction')->nullable();
            $table->longText('specimens_sent')->nullable();

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
        Schema::dropIfExists('ot_post_operation_notes');
    }
};
