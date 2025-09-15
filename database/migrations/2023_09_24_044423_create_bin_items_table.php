<?php

use App\Models\Bin;
use App\Models\Item;
use App\Models\BinGroup;
use App\Models\StockPoint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bin_items', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(BinGroup::class)->constrained();
            $table->foreignIdFor(StockPoint::class)->constrained();
            $table->foreignIdFor(Bin::class)->constrained();
            $table->foreignIdFor(Item::class)->constrained();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bin_items');
    }
};
