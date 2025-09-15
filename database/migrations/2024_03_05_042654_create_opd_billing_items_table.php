<?php

use App\Models\CorporateServiceFee;
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
        Schema::create('opd_billing_items', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\OpdBilling::class)->constrained();
            $table->boolean("is_corporate_service")->nullable();
            $table->foreignIdFor(CorporateServiceFee::class)->nullable();
            $table->foreignIdFor(\App\Models\Service\Service::class)->constrained();
            $table->foreignId('discount_approved_by_id')->nullable()->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->smallInteger('quantity')->nullable();
            $table->decimal('unit_service_price', 8, 2);
            $table->decimal('amount', 8, 2);
            $table->decimal('discount', 8, 2);
            $table->decimal('total', 8, 2);
            $table->timestamps();
            $table->softDeletes();
            $table->tinyInteger('is_cancled')->nullable()->default(0);
            $table->text('canceled_reason')->nullable();
            $table->unsignedBigInteger('canceled_approve_by_id')->nullable();
            $table->unsignedBigInteger('canceled_by_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('opd_billing_items');
    }
};
