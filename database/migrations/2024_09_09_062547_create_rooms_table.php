<?php

use App\Models\CostCenter;
use App\Models\Ipd\NurseStation;
use App\Models\Ipd\Ward;

use App\Models\Ipd\WardGroup;
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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Ward::class)->constrained();
            $table->foreignIdFor(NurseStation::class)->constrained();
            $table->foreignIdFor(CostCenter::class)->constrained();
            $table->string('name');
            $table->string('code');
            $table->string('display_name')->nullable()->default(null);
            $table->string('block')->nullable()->default(null);
            $table->string('wing')->nullable()->default(null);
            $table->tinyInteger('beds')->default(0);
            $table->boolean('status')->default(1);
            $table->foreignId('created_by_id')->nullable()->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('updated_by_id')->nullable()->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
