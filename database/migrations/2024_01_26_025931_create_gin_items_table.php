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
        Schema::create('gin_items', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\StockPoint::class)->constrained();//except Central Pharmacy
            $table->foreignIdFor(\App\Models\Gin::class)->constrained();
            $table->foreignId('stock_point_from_id')->nullable()->constrained('stock_points')->onDelete('cascade')->onUpdate('cascade');

            //grn_id is addded  because invoice_no to be print on MRQ print
            $table->foreignIdFor(\App\Models\Grn::class)->constrained();
            $table->foreignIdFor(\App\Models\Item::class)->constrained();
            $table->string('batch_no',15)->nullable();
            $table->string('mfd',20)->nullable();
            $table->string('exd',20)->nullable();
            $table->smallInteger('quantity')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gin_items');
    }
};
