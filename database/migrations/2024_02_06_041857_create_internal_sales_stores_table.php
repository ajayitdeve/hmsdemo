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
        Schema::create('internal_sales_stores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('stock_point_from_id')->nullable()->constrained('stock_points')->onDelete('cascade')->onUpdate('cascade')->default(1)->comment('Stock_point_from');
            $table->foreignIdFor(\App\Models\StockPoint::class)->constrained()->comment('Stock_point_to')->default(1);
            $table->foreignIdFor(\App\Models\Gin::class)->constrained();
            $table->foreignIdFor(\App\Models\GinItem::class)->constrained();
            $table->foreignIdFor(\App\Models\Item::class)->constrained();
            $table->string('batch_no',15)->nullable();
            $table->string('mfd',20)->nullable();
            $table->string('exd',20)->nullable();
            $table->smallInteger('quantity')->nullable();
            $table->boolean('received')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('internal_sales_stores');
    }
};
