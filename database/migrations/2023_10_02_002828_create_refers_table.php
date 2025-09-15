<?php

use App\Models\Unit;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Department;
use App\Models\PatientVisit;
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
        Schema::create('refers', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Patient::class)->constrained();
            $table->foreignIdFor(PatientVisit::class)->constrained();

            $table->foreignId('department_id_from')->nullable()->constrained('departments')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('unit_id_from')->nullable()->constrained('units')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('doctor_id_from')->nullable()->constrained('doctors')->onDelete('cascade')->onUpdate('cascade');

            $table->foreignId('department_id_to')->nullable()->constrained('departments')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('unit_id_to')->nullable()->constrained('units')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('doctor_id_to')->nullable()->constrained('doctors')->onDelete('cascade')->onUpdate('cascade');

            $table->dateTime('refer_at');
            $table->text('remarks')->nullable();
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
        Schema::dropIfExists('refers');
    }
};
