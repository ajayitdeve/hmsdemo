<?php

use App\Models\Doctor;
use App\Models\Gender;
use App\Models\Department;
use App\Models\Service\Service;
use App\Models\Service\ServiceGroup;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('formats', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Department::class);
            $table->foreignIdFor(ServiceGroup::class);
            $table->foreignIdFor(Service::class);
            $table->foreignIdFor(Gender::class)->nullable();
            $table->foreignIdFor(Doctor::class)->nullable();
            $table->string('lab_equivalent_name', 100)->nullable();
            $table->string('report_title')->nullable();
            $table->string('code', 15); //ex FMT001
            $table->string('name', 100);
            $table->string('method')->nullable();
            $table->boolean('is_gender_specific')->default(false);
            $table->boolean('is_sample_needed')->default(false);
            $table->boolean('is_default_format')->default(false);
            $table->boolean('is_growth')->default(false);
            $table->string('specimen');
            $table->string('column_cap_1')->nullable();
            $table->string('column_cap_2')->nullable();
            $table->string('column_cap_3')->nullable();
            $table->string('column_cap_4')->nullable();
            $table->boolean('is_accrediation_needed')->default(false);
            $table->boolean('is_multiple_oranism_needed')->default(false);
            $table->boolean('is_clinical_history')->default(false);
            $table->boolean('is_no_normal_range')->default(false);
            $table->string('min_time', 20)->nullable();
            $table->foreignId('time_ins_min')->nullable()->constrained('time_ins');
            $table->string('max_time', 20)->nullable();
            $table->foreignId('time_ins_max')->nullable()->constrained('time_ins');
            $table->boolean('is_active')->default(true);
            $table->foreignId('created_by_id')->nullable()->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('updated_by_id')->nullable()->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('formats');
    }
};
