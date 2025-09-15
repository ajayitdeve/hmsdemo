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
        Schema::create('mrqs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('stock_point_to_id')->nullable()->constrained('stock_points')->onDelete('cascade')->onUpdate('cascade');//central Pharmacy
            $table->foreignId('stock_point_from_id')->nullable()->constrained('stock_points')->onDelete('cascade')->onUpdate('cascade');//Op pharmacy
            $table->string('code',15)->nullable();
            $table->string('request_date',15)->nullable();
            $table->boolean('status')->default(0);
            $table->string('remarks')->nullable();
            $table->foreignId('created_by_id')->nullable()->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('approved_by_id')->nullable()->default(null)->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mrqs');
    }
};
