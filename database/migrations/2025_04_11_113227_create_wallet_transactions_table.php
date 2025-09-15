<?php

use App\Models\Ipd\Ipd;
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
        Schema::create('wallet_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Ipd::class);
            $table->foreignIdFor(Patient::class);
            $table->enum("type", ["credit", "debit"]);
            $table->decimal("amount", 10, 2);
            $table->enum("mode", ["cash", "online", "wallet"]);
            $table->string("transaction_id")->nullable();
            $table->enum("status", ["pending", "success", "failed"]);
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
        Schema::dropIfExists('wallet_transactions');
    }
};
