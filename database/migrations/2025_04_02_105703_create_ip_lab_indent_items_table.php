<?php

use App\Models\CorporateServiceFee;
use App\Models\IpLabIndent;
use App\Models\Service\Service;
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
        Schema::create('ip_lab_indent_items', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(IpLabIndent::class);
            $table->boolean("is_corporate_service")->nullable();
            $table->foreignIdFor(CorporateServiceFee::class)->nullable();
            $table->foreignIdFor(Service::class);
            $table->integer("quantity");
            $table->decimal("unit_service_price", 10, 2);
            $table->decimal("amount", 10, 2);
            $table->decimal("discount", 10, 2);
            $table->decimal("total", 10, 2);
            $table->date("service_date");
            $table->unsignedBigInteger("discount_approved_by_id")->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ip_lab_indent_items');
    }
};
