<?php

use App\Models\Ot;
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
        Schema::create('ot_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Ot::class)->constrained();
            $table->date('schedule_date');
            $table->time('schedule_time');
            $table->string('status')->default('Available');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ot_schedules');
    }
};
