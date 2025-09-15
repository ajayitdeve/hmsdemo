<?php

use App\Models\Ipd\Ipd;
use App\Models\IpPharmacyIndent;
use App\Models\IpPharmacyIndentBilling;
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
        Schema::create('ip_pharmacy_billing_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(IpPharmacyIndentBilling::class);
            $table->foreignIdFor(IpPharmacyIndent::class);
            $table->foreignIdFor(Ipd::class);
            $table->foreignIdFor(Patient::class);
            $table->foreignIdFor(StockPoint::class);
            $table->foreignIdFor(WalletTransaction::class);
            $table->decimal('amount', 10, 2)->default(0);
            $table->unsignedBigInteger('received_by_id');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ip_pharmacy_billing_transactions');
    }
};
