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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('description'); //medicine name//item description
            $table->string('code'); //
            $table->string('hsn', 10)->nullable()->default(null);
            $table->decimal('igst', 5, 2)->nullable()->default(null);;
            $table->decimal('cgst', 5, 2)->nullable()->default(null);;
            $table->decimal('sgst', 5, 2)->nullable()->default(null);;
            $table->foreignIdFor(\App\Models\Type::class)->constrained();
            $table->foreignIdFor(\App\Models\ItemGroup::class)->constrained();
            $table->foreignIdFor(\App\Models\Generic::class)->constrained();
            $table->foreignIdFor(\App\Models\Form::class)->constrained();
            $table->foreignIdFor(\App\Models\Category::class)->nullable()->constrained();
            $table->foreignIdFor(\App\Models\ItemSpecialization::class)->constrained()->nullable();
            $table->foreignIdFor(\App\Models\Manufacturer::class)->constrained()->nullable();
            //Purchase UOM
            $table->foreignId('purchase_uom_id')->nullable()->constrained('forms')->onDelete('cascade')->onUpdate('cascade');
            //Issue UOM
            $table->foreignId('issue_uom_id')->nullable()->constrained('forms')->onDelete('cascade')->onUpdate('cascade');

            $table->integer('alert_days_before_expiry')->default(0);
            $table->decimal('sale_rate_for_billing_amount', 10, 2)->default(0);
            $table->decimal('sale_rate_for_billing_percentage', 5, 2)->default(0);
            $table->enum('sale_rate_for_billing_used_for', ['both', 'opd', 'ipd'])->default('both');
            $table->boolean('is_asset')->default(false);
            $table->boolean('batch_no_required')->default(false);
            $table->boolean('is_narcotic')->default(false);
            $table->boolean('is_high_risk')->default(false);
            $table->boolean('is_non_returnable_item')->default(false);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
