<?php

use App\Models\CorporateServiceFee;
use App\Models\IpServiceBilling;
use App\Models\Service\Service;
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
        Schema::create('ip_service_billing_items', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(IpServiceBilling::class);
            $table->boolean("is_corporate_service")->nullable();
            $table->foreignIdFor(CorporateServiceFee::class)->nullable();
            $table->foreignIdFor(Service::class);
            $table->integer("quantity")->default(1);
            $table->decimal("unit_service_price", 10, 2)->nullable();
            $table->decimal("amount", 10, 2)->nullable();
            $table->decimal("discount", 10, 2)->nullable();
            $table->decimal("total", 10, 2)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ip_service_billing_items');
    }
};
