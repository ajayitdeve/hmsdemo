<?php

use App\Models\Ipd\Room;
use App\Models\Ipd\Ward;


use App\Models\CostCenter;
use App\Models\Ipd\WardGroup;
use App\Models\Service\Service;
use App\Models\Ipd\NurseStation;
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
        Schema::create('beds', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Ward::class)->constrained();
            $table->foreignIdFor(Room::class)->constrained();
            $table->string('code');
            $table->enum('bed_status',['vacant','used'])->default('vacant');
            $table->string('display_name')->nullable()->default(null);
            $table->boolean('is_dummy_room')->default(false);
            $table->boolean('is_oxygen')->default(false);
            $table->boolean('is_suction')->default(false);
            $table->boolean('is_window')->default(false);
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
        Schema::dropIfExists('beds');
    }
};
