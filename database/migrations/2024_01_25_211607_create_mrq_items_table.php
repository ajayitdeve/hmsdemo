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
        Schema::create('mrq_items', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Mrq::class)->constrained();
            $table->foreignIdFor(\App\Models\Item::class)->constrained();
            $table->smallInteger('quantity')->default(0);
            $table->smallInteger('approved_quantity')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mrq_items');
    }
};
