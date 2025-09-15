<?php

use App\Models\CostCenter;
use App\Models\Department;
use App\Models\Ipd\CorporateRelation;
use App\Models\Ipd\Ipd;
use App\Models\Ipd\Organization;
use App\Models\Patient;
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
        Schema::create('corporate_registrations', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Patient::class);
            $table->foreignIdFor(Ipd::class);
            $table->foreignIdFor(Organization::class);
            $table->foreignIdFor(CorporateRelation::class);// for relation
            $table->foreignIdFor(Department::class);//for employee department
            $table->foreignIdFor(CostCenter::class);//for branch
            $table->string('medical_card_no',20);
            $table->date('card_validity');
            $table->string('employee_no',20);
            $table->string('employee_name',30);
            $table->string('employee_designation',100);
            $table->string('referral_letter_no',20);
            $table->date('referral_letter_date');
            $table->string('purpose');
            $table->string('payment_mode');
            $table->enum('letter_for',["OP","IP"])->default("OP");
            $table->string("tpa_name",30)->nullable();
            $table->text("diagnosis")->nullable();
            $table->string("letter_issued_by",100)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('corporate_registrations');
    }
};
