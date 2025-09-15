<?php

use App\Models\Role;
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
        Schema::create('role_stock_points', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignIdFor(Role::class);
            $table->foreignIdFor(StockPoint::class);
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('role_stock_points');
    }
};
