<?php

use App\Models\Ipd\Ipd;
use App\Models\Ipd\NurseStation;
use App\Models\Patient;
use App\Models\StockPoint;
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
        Schema::create('ip_pharmacy_indents', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Ipd::class);
            $table->foreignIdFor(Patient::class);
            $table->foreignIdFor(StockPoint::class)->nullable();
            $table->string('nrq_code')->unique();
            $table->text('remarks')->nullable();
            $table->string('status')->default('Not Approved');
            $table->foreignIdFor(NurseStation::class)->nullable();
            $table->unsignedBigInteger('created_by_id');
            $table->integer('is_cancelled')->default(0);
            $table->text('cancelled_reason')->nullable();
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
        Schema::dropIfExists('ip_pharmacy_indents');
    }
};
