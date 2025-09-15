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
        Schema::create('gins', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\StockPoint::class)->constrained();
            $table->foreignIdFor(\App\Models\Mrq::class)->constrained();
            $table->foreignId('stock_point_from_id')->nullable()->constrained('stock_points')->onDelete('cascade')->onUpdate('cascade');
            //here stock point will have values except Central Pharmacy ex..OP Pharmacy
            $table->string('code',15);
            $table->boolean('status')->default(0);
            $table->string('remarks')->nullable();
            $table->foreignId('created_by_id')->nullable()->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('approved_by_id')->nullable()->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gins');
    }
};
