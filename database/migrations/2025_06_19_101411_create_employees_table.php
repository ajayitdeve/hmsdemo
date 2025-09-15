<?php

use App\Models\Bloodgroup;
use App\Models\CostCenter;
use App\Models\Department;
use App\Models\Designation;
use App\Models\EmployeeCategory;
use App\Models\Gender;
use App\Models\Marital;
use App\Models\Nationality;
use App\Models\Relation;
use App\Models\Religion;
use App\Models\Title;
use App\Models\Village;
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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(EmployeeCategory::class)->constrained();
            $table->string('employee_code', 50)->nullable()->unique();
            $table->foreignIdFor(Title::class)->constrained();
            $table->string('employee_name', 150)->nullable();
            $table->foreignIdFor(Gender::class)->constrained();
            $table->foreignIdFor(Relation::class)->constrained();
            $table->string('father_name', 150)->nullable();
            $table->date('dob')->nullable();
            $table->date('doj')->nullable();
            $table->foreignIdFor(Religion::class)->nullable();
            $table->foreignIdFor(Nationality::class)->nullable();
            $table->foreignIdFor(Marital::class)->nullable();
            $table->string('qualification', 150)->nullable();
            $table->string('qualified_university')->nullable();
            $table->foreignIdFor(Department::class)->constrained();
            $table->foreignIdFor(Designation::class)->constrained();
            $table->tinyInteger('is_hod')->nullable();
            $table->foreignIdFor(CostCenter::class)->constrained();
            $table->foreignIdFor(Bloodgroup::class)->nullable();
            $table->string('mobile', 15)->nullable();
            $table->string('email', 150)->nullable();
            $table->string('pincode', 10)->nullable();
            $table->foreignIdFor(Village::class)->constrained();
            $table->longText('address')->nullable();
            $table->unsignedBigInteger('created_by_id')->nullable();
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
        Schema::dropIfExists('employees');
    }
};
