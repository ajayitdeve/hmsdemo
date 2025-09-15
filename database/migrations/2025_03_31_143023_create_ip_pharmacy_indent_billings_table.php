<?php

use App\Models\Ipd\Ipd;
use App\Models\IpPharmacyIndent;
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
        Schema::create('ip_pharmacy_indent_billings', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(IpPharmacyIndent::class);
            $table->foreignIdFor(Ipd::class);
            $table->foreignIdFor(Patient::class);
            $table->foreignIdFor(StockPoint::class);
            $table->string('code')->unique();
            $table->decimal('total', 10, 2)->default(0);

            $table->decimal('gross_amount', 8, 2)->nullable();
            $table->decimal('discount_amount', 8, 2)->nullable();
            $table->decimal('due_amount', 8, 2)->nullable();
            $table->decimal('advance_amount', 8, 2)->nullable();
            $table->decimal('other_amount', 8, 2)->nullable();
            $table->decimal('total_amount', 8, 2)->nullable();
            $table->decimal('paid_amount', 8, 2)->nullable();
            $table->string('payment_by', 20)->nullable();
            $table->string('transaction_id', 150)->nullable();

            $table->string('drug_destination_name')->nullable();
            $table->unsignedBigInteger('created_by_id');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ip_pharmacy_indent_billings');
    }
};
