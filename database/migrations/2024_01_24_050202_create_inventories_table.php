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
        Schema::create('inventories', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Grn::class)->constrained();
            $table->foreignIdFor(\App\Models\Item::class)->constrained();
            $table->string('batch_no',15)->nullable();
            $table->string('mfd',20)->nullable();
            $table->string('exd',20)->nullable();
            $table->smallInteger('quantity')->nullable();
            $table->decimal('purchase_rate', 8, 2);
            $table->tinyInteger('bonus')->nullable();
            $table->decimal('mrp', 8, 2);
            $table->decimal('discount',4,2);
            $table->decimal('tax', 4, 2);
            $table->string('hsncode',10);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventories');
    }
};
