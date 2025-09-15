<?php

use App\Models\Equipment;
use App\Models\EquipmentGroup;
use App\Models\IpdEquipmentUsage;
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
        Schema::create('ipd_equipment_usage_items', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(IpdEquipmentUsage::class);
            $table->foreignIdFor(EquipmentGroup::class);
            $table->foreignIdFor(Equipment::class);
            $table->string("equipment_code")->nullable();
            $table->timestamp("from_date_time")->nullable();
            $table->timestamp("to_date_time")->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ipd_equipment_usage_items');
    }
};
