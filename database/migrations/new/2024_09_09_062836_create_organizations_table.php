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
            $table->string('code', 20);
            $table->string('name');
            $table->string('gstcode', 20)->nullable();
            $table->string('pan', 20)->nullable();
            $table->string('color', 20)->nullable();
            $table->enum('type', ['I', 'C'])->comment("Organization Type: I- Insurance C- Company");
            $table->boolean('isactive')->default(true)->comment('0: inactive 1:active');
            $table->boolean('isletterrequired')->default(false)->comment('0: inactive 1:active');

            $table->date('effectedfrom')->nullable();
            $table->date('effectedto')->nullable();

            $table->tinyInteger('clearancedays')->comment('Billing Cycle days');

            $table->date('contractfrom')->nullable();
            $table->date('contractto')->nullable();

            $table->tinyInteger('consultations')->nullable()->comment('Number of consultations');
            $table->tinyInteger('consultationduration')->nullable()->comment('Consultation duration in days');

            $table->tinyInteger('ip_org_percent')->nullable()->comment('IP ORG %');
            $table->tinyInteger('ip_emp_percent')->nullable()->comment('IP EMP %');
            $table->tinyInteger('op_org_percent')->nullable()->comment('OP ORG %');
            $table->tinyInteger('op_emp_percent')->nullable()->comment('OP EMP %');

            //Teriff Priority for IP
            $table->foreignId('teriff_priority_ip_first')->nullable()->constrained('teriffs');
            $table->foreignId('teriff_priority_ip_second')->nullable()->constrained('teriffs');
            $table->foreignId('teriff_priority_ip_third')->nullable()->constrained('teriffs');
            $table->foreignId('teriff_priority_ip_default')->nullable()->constrained('teriffs');

            //Teriff Priority for OP
            $table->foreignId('teriff_priority_op_first')->nullable()->constrained('teriffs');
            $table->foreignId('teriff_priority_op_second')->nullable()->constrained('teriffs');
            $table->foreignId('teriff_priority_op_third')->nullable()->constrained('teriffs');
            $table->foreignId('teriff_priority_op_default')->nullable()->constrained('teriffs');

            $table->foreignIdFor(CostCenter::class)->nullable();
            $table->foreignId('created_by_id')->nullable()->constrained('users')->onDelete('cascade')->onUpdate('cascade');

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
