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
        Schema::create('rates', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Item::class)->constrained();
            $table->string('batch_no',15);
            $table->decimal('current_purchase_rate', 8, 2);
            $table->decimal('current_sale_rate', 8, 2);
            $table->decimal('new_purchase_rate', 8, 2);
            $table->decimal('new_sale_rate', 8, 2);
            $table->string('doc')->nullable();//doc date of change
            $table->boolean('status')->default(false);
            $table->foreignId('approved_by_id')->nullable()->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('remarks')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rates');
    }
};
