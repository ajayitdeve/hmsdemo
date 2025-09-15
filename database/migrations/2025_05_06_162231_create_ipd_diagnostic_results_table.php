<?php

use App\Models\IpServiceBilling;
use App\Models\Pathology\IpdSampleCollection;
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
        Schema::create('ipd_diagnostic_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->nullable()->constrained('patients')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('patient_visit_id')->nullable()->constrained('patient_visits')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('doctor_id')->nullable()->constrained('doctors')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignIdFor(IpdSampleCollection::class);
            $table->foreignIdFor(IpServiceBilling::class);
            $table->string('ref_no', 20)->nullable();
            $table->string('code', 20)->nullable();
            $table->boolean('status')->default(0);
            $table->string('result_date', 20)->nullable();
            $table->foreignId('created_by_id')->nullable()->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('updated_by_id')->nullable()->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('approved_by_id')->nullable()->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ipd_diagnostic_results');
    }
};
