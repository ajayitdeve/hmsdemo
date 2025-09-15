<?php

use App\Models\CostCenter;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('organizations', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(CostCenter::class)->nullable();
            $table->string('code', 20);
            $table->string('name');
            $table->string('gstcode', 20)->nullable();
            $table->string('pan', 20)->nullable();
            $table->string('tan', 20)->nullable();
            $table->string('color', 20)->nullable();
            $table->enum('type', ['I', 'C'])->comment("Organization Type:  I- Insurance C-Corporate");
            $table->boolean('isactive')->default(true)->comment('0: inactive 1:active');
            $table->boolean('isletterreqcoloruired')->default(false)->comment('0: inactive 1:active');
            $table->date('effectedfrom')->nullable();
            $table->date('effectedto')->nullable();
            $table->tinyInteger('clearancedays')->comment('Billing Cycle days');
            $table->date('contractdate')->nullable();

            $table->tinyInteger('consultation_number')->nullable()->comment('Number of consultations');
            $table->tinyInteger('consultation_days')->nullable()->comment('Consultation duration in days');
            $table->decimal('consultation_discount',4,2)->nullable()->default(0);

            $table->tinyInteger('ip_org_percent')->nullable()->comment('IP ORG %');
            $table->tinyInteger('ip_emp_percent')->nullable()->comment('IP EMP %');
            $table->tinyInteger('op_org_percent')->nullable()->comment('OP ORG %');
            $table->tinyInteger('op_emp_percent')->nullable()->comment('OP EMP %');



            //address
            $table->string('address')->nullable();
            $table->string('city' ,60)->nullable();
            $table->string('state' ,60)->nullable();
            $table->string('country' ,60)->nullable();
            $table->string('pincode',10)->nullable();
            $table->string('phone' ,15)->nullable();
            $table->string('alt_phone' ,15)->nullable();
            $table->string('remarks')->nullable();
            $table->string('email' ,60)->nullable();
            //pharmacy
            $table->enum('pharmacy', ['cash', 'credit'])->comment("Pharmacy Cash/Credit");
            $table->decimal('org_credit_limit',8,2)->nullable()->default(0);
            $table->foreignId('contact_person_id')->nullable()->constrained('users')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('organizations');
    }
};
