<?php

use App\Models\Ipd\Ipd;
use App\Models\IpLabIndent;
use App\Models\Patient;
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
        Schema::create('ip_service_billings', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(IpLabIndent::class);
            $table->foreignIdFor(Ipd::class);
            $table->foreignIdFor(Patient::class);
            $table->string("code")->unique();
            $table->decimal("total")->nullable();
            $table->string("remarks")->nullable();
            $table->unsignedBigInteger("created_by_id")->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ip_service_billings');
    }
};
