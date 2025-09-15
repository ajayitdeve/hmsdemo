<?php

use App\Models\Ipd\Ipd;
use App\Models\IpLabIndent;
use App\Models\IpServiceBilling;
use App\Models\Patient;
use App\Models\StockPoint;
use App\Models\WalletTransaction;
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
        Schema::create('ip_service_billing_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(IpServiceBilling::class);
            $table->foreignIdFor(IpLabIndent::class);
            $table->foreignIdFor(Ipd::class);
            $table->foreignIdFor(Patient::class);
            $table->foreignIdFor(WalletTransaction::class);
            $table->decimal('amount', 10, 2)->default(0);
            $table->unsignedBigInteger('received_by_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ip_service_billing_transactions');
    }
};
