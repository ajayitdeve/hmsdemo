<?php

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
        //this table will store amount received as consultation charge
        Schema::create('consultation_charges', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Patient::class)->constrained();
            $table->foreignIdFor(\App\Models\PatientVisit::class)->constrained();
            $table->decimal('amount', 8, 2);

            $table->boolean('foc')->nullable()->default(false);
            $table->foreignId('received_by_id')->nullable()->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('foc_by_id')->nullable()->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consultation_charges');
    }
};
