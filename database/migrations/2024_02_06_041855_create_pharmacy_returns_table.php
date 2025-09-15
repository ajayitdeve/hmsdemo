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
        Schema::create('pharmacy_returns', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\StockPoint::class)->constrained();
            $table->foreignIdFor(\App\Models\Patient::class)->constrained();
            $table->foreignIdFor(\App\Models\OpdMedicineReceipt::class)->constrained();
            $table->string('code',15)->nullable();
            $table->date('return_date')->nullable();
            $table->enum('patient_type',['op','ip'])->default('op');
            $table->string('cause')->nullable();
            $table->string('remarks')->nullable();
            $table->foreignId('created_by_id')->nullable()->constrained('users')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('pharmacy_returns');
    }
};
