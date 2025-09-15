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
        Schema::create('vendors', function (Blueprint $table) {
            $table->id();

            $table->string('code', 15);
            $table->string('name', 150);
            $table->string('legal_name', 150);
            $table->string('address', 255)->nullable();
            $table->string('phone', 25)->nullable();
            $table->string('cst_no', 50)->nullable();
            $table->string('drug_license_no', 50)->nullable();
            $table->string('drug_license_exp_date', 50)->nullable();
            $table->string('gst_no', 50);
            $table->string('pan_no', 15)->nullable();
            $table->integer('payment_days')->nullable();
            $table->integer('delivery_days')->nullable();

            $table->foreignIdFor(\App\Models\Type::class);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendors');
    }
};
