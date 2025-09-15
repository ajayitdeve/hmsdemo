<?php

use App\Models\Doctor;
use App\Models\VisitType;
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
        Schema::create('patient_visits', function (Blueprint $table) {
            $table->id();
            $table->string('visit_no')->nullable();
            $table->string('visit_type')->nullable(); //0 Paid  1 free
            $table->decimal('fee', 6, 2);
            $table->boolean('foc')->nullable()->default(false);
            $table->decimal('discount', 6, 2);
            $table->date('visit_date')->nullable();
            $table->tinyInteger('visit_status')->default(0)->comment('when complete the status will change');
            //discriptions will be treated as remarks
            $table->text('description')->nullable();
            $table->foreignIdFor(\App\Models\Patient::class)->nullable()->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignIdFor(Doctor::class)->nullable();
            $table->foreignIdFor(VisitType::class)->nullable();
            $table->foreignIdFor(\App\Models\Unit::class)->constrained('units')->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\Department::class)->constrained('departments')->cascadeOnDelete(); //added on 2-9-2024
            $table->foreignId('created_by_id')->nullable()->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('updated_by_id')->nullable()->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->text('cancelled_reason')->nullable();
            $table->unsignedBigInteger('cancelled_approve_by_id')->nullable();
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
        Schema::dropIfExists('patient_visits');
    }
};
