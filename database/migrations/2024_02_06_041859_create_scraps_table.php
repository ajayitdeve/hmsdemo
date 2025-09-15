<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    //'stock_point_from_id','stock_point_to_id','code','remarks','scrap_transfer_date','status','created_by_id','updated_by_id','approved_by_id'
    public function up(): void
    {
        Schema::create('scraps', function (Blueprint $table) {
            $table->id();
            $table->foreignId('stock_point_from_id')->nullable()->constrained('stock_points')->onDelete('cascade')->onUpdate('cascade')->comment('Stock_point_from');
            $table->foreignId('stock_point_to_id')->nullable()->constrained('stock_points')->onDelete('cascade')->onUpdate('cascade')->comment('Stock_point_to');
            $table->string('code',20)->nullable();
            $table->text('remarks')->nullable()->default(null);
            $table->dateTime('scrap_transfer_date')->nullable()->default(null);
            $table->boolean('status')->default(false);
            $table->foreignId('created_by_id')->nullable()->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('updated_by_id')->nullable()->constrained('users')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('scraps');
    }
};
