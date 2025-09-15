<?php

use App\Models\OpdBilling;
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
        Schema::create('opd_billing_discounts', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(OpdBilling::class);
            $table->decimal('discount', 8, 2)->nullable();
            $table->foreignId('discount_approved_by_id')->nullable()->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('opd_billing_discounts');
    }
};
