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
        Schema::create('purchase_indents', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\StockPoint::class)->constrained();
            $table->foreignIdFor(\App\Models\Vendor::class)->constrained();
            $table->foreignIdFor(\App\Models\Type::class)->constrained();
            $table->string('code',15)->nullable();
            $table->string('date',20)->nullable();
            $table->string('request_date',15)->nullable();
            $table->boolean('status')->default(0);
            $table->string('remarks')->nullable();
            $table->foreignId('created_by_id')->nullable()->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_indents');
    }
};
